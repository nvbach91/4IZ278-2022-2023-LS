Vue.createApp({
  data() {
    return {
      profile: null,
      oldPass: "",
      newPass: "",
      newPassC: "",
    };
  },
  methods: {
    loadUserData() {
      axios
        .get(API_URL + "/getUserProfile")
        .then((response) => {
          this.profile = response.data;
        })
        .catch((e) => {
          window.location = BASE_URL + "/signin";
        });
    },
    saveProfile() {
      axios
        .post(API_URL + "/setUserProfile", this.profile)
        .then((response) => {
          this.loadUserData();
        })
        .catch((e) => {
          window.location = BASE_URL + "/signin";
        });
    },
    changePass() {
      axios
        .post(API_URL + "/changePassword", {
          oldPass: this.oldPass,
          newPass: this.newPass,
        })
        .then((response) => {
          alert("success");
        })
        .catch((e) => {
          if (e.response.status == 403) {
            window.location = BASE_URL + "/signin";
          } else {
            alert(e.response.data.error);
          }
        });
    },
  },
  created() {
    this.loadUserData();
  },
}).mount("#profile");
