Vue.createApp({
  data() {
    return {
      reservations: [],
      edit: null,
      add: false,

      available: [],
      newTable: null,
      newNote: null,

      tables: null,
      place: null,
      dateNew: "",
      noteNew: "",
    };
  },
  methods: {
    getBlocks() {
      axios
        .get(API_URL + "/getAllBlocks")
        .then((response) => {
          this.blocks = response.data;
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
    editBlock(b) {
      this.newTable = b.table_id;
      this.newNote = b.note;
      this.edit = b;
    },
    saveNewBlock() {
      axios
        .post(API_URL + "/createBlock", {
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
    deleteBlock(id) {
      axios
        .post(API_URL + "/deleteBlock", { id })
        .then((response) => {
          this.edit = null;
          window.location.reload();
        })
        .catch((e) => {
          alert(e.response.data.error);
        });
    },
    saveBlock() {
      axios
        .post(API_URL + "/editBlock", {
          id: this.edit.id,
          note: this.newNote,
          table_id: this.newTable,
        })
        .then((response) => {
          this.edit = null;
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
    dateNew(newVal, oldVal) {
      if (!newVal) {
        this.dateNew = oldVal;
      } else {
        this.getTablesForDate();
      }
    },
  },
  created() {
    this.dateNew = new Date().toISOString().split("T")[0];
    this.getBlocks();
    this.getTablesForDate();
  },
}).mount("#blocks");
