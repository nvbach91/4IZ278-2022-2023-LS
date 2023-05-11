Vue.createApp({
  data() {
    return {
      user: {
        email: "",
        password: "",
      },
    };
  },
  methods: {
    getBlocksForDay(date) {
      axios.get(API_URL + "/getBlocksForDate?date=" + date).then((response) => {
        console.log(response);
      });
    },
  },
  mounted() {
    this.getBlocksForDay("2023-05-11");
  },
}).mount("#visit");
