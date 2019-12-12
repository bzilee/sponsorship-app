
import CountDownComponent from './components/CountDownComponent';
import RegisterComponent from './components/StepperComponent2';
import VueStar1 from './components/VueStartComponent';
import VueStar2 from 'vue-star';
import SingleCountDownComponent from './components/SingleCountDownComponent';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.filter('two_digits', (value) => {
    if (value < 0) {
      return '00';
    }
    if (value.toString().length <= 1) {
      return `0${value}`;
    }
    return value;
  });


const app = new Vue({
    el: '#app',
    components: {
        "countdown" : CountDownComponent,
        'register' : RegisterComponent,
        'vue-star' : VueStar1,
        'SingleCountDown' : SingleCountDownComponent,

    }
});
