
 <template>
        <div id="single-count-down" class="s-color-green" >

            {{ seconds  }}
        </div>
</template>

<script>
    export default {
        name: 'single-count-down',
        props: {
            time: {
                type: String
            }
        },
        data() {
            return {
                now: parseInt(this.time),

            }
        },

        mounted() {
          let interval =   window.setInterval(() => {
                this.now = this.now - 1;

                if (this.seconds == 3) {
                    $('#player')[0].play();
                }

                if (this.seconds == 0) {
                     clearInterval(interval);
                    $.get("/sponsorship/join",function () {

                    })
                    .done(function() {
                        $('#single-countdown').css('display', 'none');

                    })
                    .fail(function() {}).
                    always(function () {

                    });
                    $.get("/sponsorship/begin");
                }
            },1000);
        },
        computed: {
            seconds() {
                return this.now;
            }
        }
    }

</script>
