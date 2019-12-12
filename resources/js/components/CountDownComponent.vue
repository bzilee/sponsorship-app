
 <template>
        <div id="countdown" class="s-color-green" >
            {{ days | two_digits }}:
            {{ hours | two_digits }}:
            {{ minutes | two_digits }}:
            {{ seconds | two_digits }}
        </div>
</template>

<script>
    export default {
        name: 'countdown',
        props: {
            date: {
                type: String
            },
            url: {
                type: String
            }
        },
        data() {
            return {
                now: Math.trunc((new Date()).getTime() / 1000),

            }
        },

        mounted() {
            let interval = window.setInterval(() => {
                this.now = Math.trunc((new Date()).getTime() / 1000);
                if (this.days <= 0 && this.hours <= 0 && this.minutes <= 0 && this.seconds <= 0) {
                    clearInterval(interval);
                    window.location.replace(this.url);
                }

            },1000);
        },
        computed: {
            dateInMilliseconds() {
                //let dateInMilliseconds_ = Math.trunc(Date.parse(this.date) / 1000);
                return Math.trunc(Date.parse(this.date) / 1000);
            },
            seconds() {
               // this.seconds_ = (this.dateInMilliseconds - this.now) % 60;
                return(this.dateInMilliseconds - this.now) % 60;
            },
            minutes() {
                this.minutes_ = Math.trunc((this.dateInMilliseconds - this.now) / 60) % 60;
                return this.minutes_
            },
            hours() {
                this.hours_ = Math.trunc((this.dateInMilliseconds - this.now) / 60 / 60) % 24;
                return this.hours_;
            },
            days() {
                this.seconds_ = Math.trunc((this.dateInMilliseconds - this.now) / 60 / 60 / 24);
                return this.seconds_;
            }
        }
    }

</script>
