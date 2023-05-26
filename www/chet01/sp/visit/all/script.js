Vue.createApp({
  data() {
    return {
      reservations: [],
      edit: null,
      available: [],
      newTable: null,
      newNote: null,
    };
  },
  created() {
    this.getRes();
  },
  methods: {
    getRes() {
      axios
        .get(API_URL + "/getUsersReservations")
        .then((response) => {
          this.reservations = response.data;
        })
        .catch((e) => {
          window.location = BASE_URL + "/signin";
        });
    },
    editRes(r) {
      this.newTable = r.table_id;
      this.newNote = r.note;
      this.edit = r;
    },
    deleteRes(id) {
      axios
        .post(API_URL + "/deleteReservation", { id })
        .then((response) => {
          this.edit = null;
          this.getRes();
        })
        .catch((e) => {
          window.location = BASE_URL + "/signin";
        });
    },
    saveRes() {
      axios
        .post(API_URL + "/editReservation", {
          id: this.edit.id,
          note: this.newNote,
          table_id: this.newTable,
        })
        .then((response) => {
          this.edit = null;
          this.getRes();
        })
        .catch((e) => {
          window.location = BASE_URL + "/signin";
        });
    },
  },
  watch: {
    edit(val) {
      if (val) {
        axios
          .get(API_URL + "/getTablesForDate?date=" + val.date)
          .then((response) => {
            this.available = response.data;
          });
      } else {
        this.available = [];
        this.newTable = null;
        this.newNote = null;
      }
    },
  },
}).mount("#all");
