Vue.createApp({
  data() {
    return {
      user: {
        firstname: "",
        surname: "",
        email: "",
        password: "",
        phone: "",
      },
      retype: "",
    };
  },
  methods: {
    sendForm() {
      axios
        .post(API_URL + "/registerUser", this.user)
        .then((response) => {
          if (response) {
            window.location = BASE_URL + "/signin";
          }
        })
        .catch((e) => {
          alert(e.response.data.error);
        });
    },
  },
}).mount("#signup");
