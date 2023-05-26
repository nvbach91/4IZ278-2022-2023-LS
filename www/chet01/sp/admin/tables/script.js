Vue.createApp({
  data() {
    return {
      tables: [],
      oldname: "",
    };
  },
  created() {
    this.getTables();
  },
  methods: {
    getTables() {
      axios
        .get(API_URL + "/getTables")
        .then((response) => {
          this.tables = response.data;
        })
        .catch((e) => {
          alert(e.response.data.error);
        });
    },
    changeName(data) {
      if (data.value !== this.oldname) {
        axios
          .post(API_URL + "/renameTable", { id: data.id, name: data.value })
          .then((response) => {
            window.location.reload();
          })
          .catch((e) => {
            alert(e.response.data.error);
          });
      } else {
        this.oldname = "";
      }
    },
    minusTable(id) {
      let newcap = this.tables.find((t) => t.id === id).capacity - 1;
      axios
        .post(API_URL + "/setTableCapacity", { id: id, capacity: newcap })
        .then((response) => {
          window.location.reload();
        })
        .catch((e) => {
          alert(e.response.data.error);
        });
    },
    plusTable(id) {
      let newcap = this.tables.find((t) => t.id === id).capacity + 1;
      axios
        .post(API_URL + "/setTableCapacity", { id: id, capacity: newcap })
        .then((response) => {
          window.location.reload();
        })
        .catch((e) => {
          alert(e.response.data.error);
        });
    },
  },
}).mount("#tables");
