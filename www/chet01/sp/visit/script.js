Vue.createApp({
  data() {
    return {
      tables: null,
      date: "",
      place: "",
      note: "",
    };
  },
  methods: {
    getTablesForDate(date) {
      axios
        .get(API_URL + "/getTablesForDate?date=" + date)
        .then((response) => {
          this.tables = response.data;
          this.place = "";
        })
        .catch((e) => {
          window.location = BASE_URL + "/signin";
        });
    },
    sendForm() {
      axios
        .post(API_URL + "/createReservation", {
          date: this.date,
          table: this.place,
          note: this.note,
        })
        .then((response) => {
          alert("Success");
          this.getTablesForDate(this.date);
          this.note = "";
        })
        .catch((e) => {
          alert(e.response.data.error);
        });
    },
  },
  created() {
    this.date = new Date().toISOString().split("T")[0];
    this.getTablesForDate(this.date);
  },
  watch: {
    date(newVal, oldVal) {
      if (!newVal) {
        this.date = oldVal;
      } else {
        this.getTablesForDate(newVal);
      }
    },
  },
}).mount("#visit");
