Vue.createApp({
  data() {
    return {
      blocks: null,
    };
  },
  methods: {
    getBlocksForDay(date) {
      axios.get(API_URL + "/getBlocksForDate?date=" + date).then((response) => {
        console.log(response);
        this.blocks = response.data;
      });
    },
  },
  mounted() {
    this.getBlocksForDay("2023-05-11");
  },
}).mount("#visit");
