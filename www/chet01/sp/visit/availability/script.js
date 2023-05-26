Vue.createApp({
  data() {
    return {
      months: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
      month: null,
      blocked: [],
      tables: [],
      place: null,
      loading: true,
    };
  },
  mounted() {
    this.month = new Date().getMonth() + 1;
    this.getTables(new Date().toISOString().split("T")[0]);
  },
  methods: {
    getTables(date) {
      axios
        .get(API_URL + "/getTables")
        .then((response) => {
          this.tables = response.data;
          this.place = this.tables[0].id;
          this.tables.forEach((t) => {
            this.loadBlocks(t.id);
          });
          this.loading = false;
          this.loadBlocks();
        })
        .catch((e) => {
          // window.location = BASE_URL + "/signin";
        });
    },
    loadBlocks(table) {
      axios
        .get(
          API_URL +
            "/getUnavailableDaysInMonth?table=" +
            table +
            "&month=" +
            this.month +
            "&year=2023"
        )
        .then((response) => {
          this.blocked = response.data.blocks;
          if (table) {
            this.tables.find((t) => t.id == table).full = response.data.full;
          }
        });
    },
  },
  watch: {
    month() {
      this.loadBlocks();
    },
    place() {
      this.loadBlocks();
    },
  },
}).mount("#aval");
