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
    sendForm() {
      axios
        .post(API_URL + "/loginUser", this.user)
        .then((response) => {
          if (response.data.perm === 1) {
            window.location = BASE_URL + "/admin";
          } else if (response.data.perm === 0) {
            window.location = BASE_URL + "/visit";
          }
        })
        .catch((e) => {
          alert(e.response.data.error);
        });
    },
  },
}).mount("#signin");
