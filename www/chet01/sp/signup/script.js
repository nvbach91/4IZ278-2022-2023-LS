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
      axios.post(API_URL + "/registerUser", this.user).then((response) => {
        console.log(response);
      });
    },
  },
}).mount("#signup");
