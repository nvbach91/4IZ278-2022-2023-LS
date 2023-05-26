Vue.createApp({
  data() {
    return {
      cafedata: null,
    };
  },
  methods: {
    loadCafeData() {
      axios.get(API_URL + "/getCafeData").then((response) => {
        this.cafedata = response.data;
      });
    },
    saveData() {
      axios
        .post(API_URL + "/setCafeData", this.cafedata)
        .then((response) => {
          window.location.reload();
        })
        .catch((e) => {
          alert(e.response.data.error);
        });
    },
  },
  created() {
    this.loadCafeData();
  },
}).mount("#cafedata");
