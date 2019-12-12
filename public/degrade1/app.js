const app = new Vue({
    el:'#app',
    data() {
      return {
        step:1,
        registration:{
          name:null,
          email:null,
          street:null,
          city:null,
          state:null,
          numtickets:0,
          shirtsize:'XL'
        }
      }
    },
    methods:{
      prev() {
        this.step--;
      },
      next() {
        this.step++;
      }
    }
  });
