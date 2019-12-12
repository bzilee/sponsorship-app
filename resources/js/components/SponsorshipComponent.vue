<template>
    <div class="row justify-content-center" >
     <div class="col-md-10 col-lg-10 col-sm-12 flex-center group-percent-evolution">
            <p class="typo-comic-20px s-color-green">Evolution <i>%</i></p>
        </div>
        <div class="col-md-10 col-lg-12 col-sm-12 flex-center group-affiliate">

            <div class="row">
                <div class="col-lg-1 col-md-1">
                    <div class="col-lg-5  group-children">
                        <img class="all-chilren" :src="img_child1" alt="">
                    </div>
                    <div class="col-lg-5 group-children">
                            <img class="all-chilren" :src="img_child2" alt="">
                    </div>
                    <div class="col-lg-5 group-children">
                            <img class="all-chilren" :src="img_child3" alt="">
                    </div>
                </div>
                <div :class="{ 'bounceInRight' : isAnimatedParent, 'zoomOut' :  !isAnimatedParent }" class="animated col-lg-5 col-md-5 offset-lg-1 offset-md-1 group-parent" id="style-parent">
                    <img class="parent-img" :src="img_url_parent" alt="">
                </div>

                <div  :class="{ 'bounceInRight' : isAnimatedChild, 'zoomOut' :  !isAnimatedChild }"  class="animated col-lg-5 col-md-5 group-child">
                    <img class="child-img" :src="img_url_child" alt="">
                </div>
            </div>

        </div>
        <div class="col-md-10 col-lg-10 col-sm-12 flex-center">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                        <p class="typo-comic name-parent">{{ name_parent }}</p>
                </div>
                <div class="col-lg-6 col-md-6">
                        <p class="typo-comic name-child">{{ name_child }}</p>
                </div>
            </div>
        </div>

    </div>
</template>


<script>
    export default {
        name: 'single-countdown',
        props: {
            /*time: {
                type: String
            }*/
        },
        data : /*() {
            return */{
                img_url_child: window.location.hostname+"/Images/user.jpg",
                img_url_parent : window.location.hostname+"/Images/user.jpg",
                img_child1 : window.location.hostname+"/Images/user.jpg",
                img_child2 : window.location.hostname+"/Images/user.jpg",
                img_child3 : window.location.hostname+"/Images/user.jpg", //http://192.168.8.2
                name_parent : "Parrain",
                name_child : "Filleul",

                //isAnimatedParent : false,
               // isAnimatedChild : false,
                //activedAnimation : false,
                tmp : null,

          //  }
        },

        mounted() {

            window.Echo.channel('sponsorship').listen(
                'SponsorshipEvent',
                (e) => {

                    this.img_url_child = e.data.avatar_child;
                    this.tmp = e.data.avatar_child;

                    this.img_url_parent = e.data.avatar_parent;
                    this.tmp = e.data.avatar_parent;

                    this.name_parent = e.data.name_parent;
                    this.name_child = e.data.name_child;


                }
            );
        },
         computed: {
           isAnimatedParent() {
                return this.img_url_parent != window.location.hostname+"/Images/user.jpg" || this.img_url_parent != this.tmp ? true : false;
            },
            isAnimatedChild() {
                return this.img_url_child != window.location.hostname+"/Images/user.jpg" || this.img_url_child != this.tmp ? true : false;
            }
        }
    }

</script>
