
import SingleCountDownComponent from './components/SingleCountDownComponent';
import SponsorshipComponent from './components/SponsorshipComponent';

const simpleCountDown = new Vue({
    //el: '#app',
    components: {'SingleCountDown' : SingleCountDownComponent,}}
);
const sponsorshipVue = new Vue({
    //el: '#app',
    components: {'sponsorship' : SponsorshipComponent,}}
);

window.Echo.channel('sponsorship').listen(
    'StartCountDownSponsorshipEvent',
    (e) => {
        simpleCountDown.$mount('#simple-countdown');
        $("#client-loader").css('display','none');
        $("#text-wait").css('display','none');
    }
).listen(
    'JoinSponsorshipEvent',
    (e) => {
        //simpleCountDown.$destroy();
        $("#cover").css('display','none');
        sponsorshipVue.$mount('#sponsorship-mount')
    }
);

$(document).ready(function () {

    $("#btn-start-sponsorship").on("click", function (e) {
        e.preventDefault();
        $.get("/sponsorship/starting",function () {
            $("#btn-start-sponsorship").css('display','none');
            $("#admin-loader").css('display','inline-block');
         })
            .done(function() {
                $("#admin-loader").css('display','none');

            })
            .fail(function() {
                $("#btn-start-sponsorship").css('display','inline-block');
            })
            .always(function() {
                console.log( "finished" );
            });

    });

});

