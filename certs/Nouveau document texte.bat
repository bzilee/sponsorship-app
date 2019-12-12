#!/usr/bin/env bash

if [ -z $(which openssl) ]; then
    echo -e "\e[31mThe package openssl is required.\e[39m"
    exit
fi

_output_dir=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )
echo "Output directory? [${_output_dir}]"
read
if [ ! -z ${REPLY} ]; then
    _output_dir=${REPLY}
fi

if [ ! -d ${_output_dir} ]; then echo "This directory doesn't exist."; exit 1; fi

_project_name="MyProject"
echo "Project name? [${_project_name}]"
read
if [ ! -z ${REPLY} ]; then
    _project_name=${REPLY}
fi
_authority="${_project_name}"


_project_domain="my-project.localhost"
echo "Project domain? [${_project_domain}]"
read
if [ ! -z ${REPLY} ]; then
    _project_domain=${REPLY}
fi
_name="${_project_domain}"

_cert_pem=${_output_dir}/${_name}.pem
_cert_crt=${_output_dir}/${_name}.crt
_cert_key=${_output_dir}/${_name}.key

_key=/tmp/${_name}.key
_cn=${_name}
_csr_cnf=/tmp/${_name}.csr.cnf
_csr=/tmp/${_name}.csr
_v3_ext=/tmp/${_name}.v3.ext
_srl=/tmp/${_name}.srl

cat << EOF > ${_csr_cnf}
[req]
default_bits = 2048
prompt = no
default_md = sha256
distinguished_name = dn

[dn]
O=${_authority}
CN=${_name}
EOF

cat << EOF > ${_v3_ext}
authorityKeyIdentifier=keyid,issuer
basicConstraints=CA:FALSE
keyUsage = digitalSignature, nonRepudiation, keyEncipherment, dataEncipherment
subjectAltName = @alt_names

[alt_names]
DNS.1 = ${_name}
DNS.2 = *.${_name}
EOF

openssl genrsa -out ${_key} 2048 >/dev/null 2>&1

openssl req -x509 -new -nodes -key ${_key} -sha256 -days 3650 -out ${_cert_pem} -subj "/O=${_authority}/CN=${_cn}" >/dev/null 2>&1

openssl req -new -sha256 -nodes -out ${_csr} -newkey rsa:2048 -keyout ${_cert_key} -config <( cat ${_csr_cnf} ) >/dev/null 2>&1

openssl x509 -req -in ${_csr} -CA ${_cert_pem} -CAcreateserial -CAserial ${_srl} -CAkey ${_key} -out ${_cert_crt} -days 3650 -sha256 -extfile ${_v3_ext} >/dev/null 2>&1

_vhost_apache=${_output_dir}/${_name}.vhost-apache.conf
_vhost_nginx=${_output_dir}/${_name}.vhost-nginx.conf

cat << EOF > ${_vhost_apache}
<IfModule mod_ssl.c>
	<VirtualHost _default_:80>
		ServerName ${_name}
		Redirect / https://${_name}
	</VirtualHost>
	<VirtualHost _default_:443>
		ServerName ${_name}
		SSLCertificateFile "/etc/ssl/certs/${_name}.crt"
		SSLCertificateKeyFile "/etc/ssl/private/${_name}.key"
		DocumentRoot /var/www/html
	</VirtualHost>
</IfModule>
EOF

cat << EOF > ${_vhost_nginx}
server {
	listen 80 default_server;
	listen [::]:80 default_server;
    server_name ${_name};
    return 302 https://\$server_name\$request_uri;
}
server {
	listen 443 ssl default_server;
	listen [::]:443 ssl default_server;
	root /var/www/html;
    server_name ${_name};
    ssl_certificate /etc/ssl/certs/${_name}.crt;
    ssl_certificate_key /etc/ssl/private/${_name}.key;
}
EOF