Vue.createApp({
  data() {
    return {
      reservations: [],
      date: "",
      edit: null,
      add: false,

      available: [],
      newTable: null,
      newNote: null,

      tables: null,
      place: null,
      dateNew: "",
      noteNew: "",
      customers: null,
      customerNew: 1,
    };
  },
  created() {
    this.date = new Date().toISOString().split("T")[0];
    this.dateNew = new Date().toISOString().split("T")[0];
    this.getRes();
    this.getTablesForDate();
    this.getAllUsers();
  },
  methods: {
    getRes() {
      axios
        .get(API_URL + "/getReservationsForDate?date=" + this.date)
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
    getTablesForDate() {
      axios
        .get(API_URL + "/getTablesForDate?date=" + this.dateNew)
        .then((response) => {
          this.tables = response.data;
          this.place = "";
        })
        .catch((e) => {
          window.location = BASE_URL + "/signin";
        });
    },
    getAllUsers() {
      axios
        .get(API_URL + "/getAllUsers")
        .then((response) => {
          this.customers = response.data;
        })
        .catch((e) => {
          window.location = BASE_URL + "/signin";
        });
    },
    saveNewRes() {
      axios
        .post(API_URL + "/createAdminReservation", {
          user: this.customerNew,
          note: this.noteNew,
          date: this.dateNew,
          table: this.place,
        })
        .then((response) => {
          window.location.reload();
        })
        .catch((e) => {
          alert(e.response.data.error);
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
    date(newVal, oldVal) {
      if (!newVal) {
        this.date = oldVal;
      } else {
        this.getRes();
      }
    },
    dateNew(newVal, oldVal) {
      if (!newVal) {
        this.dateNew = oldVal;
      } else {
        this.getTablesForDate();
      }
    },
  },
}).mount("#admin");
