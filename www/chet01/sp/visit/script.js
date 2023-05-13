Vue.createApp({
  data() {
    return {
      blocks: null,
    };
  },
  methods: {
    getBlocksForDay(date) {
      axios
        .get(API_URL + "/getBlocksForDate?date=" + date)
        .then((response) => {
          console.log(response);
          this.blocks = response.data;
        })
        .catch((e) => {
          window.location = BASE_URL + "/signin";
        });
    },
  },
  beforeMount() {
    this.getBlocksForDay("2023-05-11");
  },
}).mount("#visit");
