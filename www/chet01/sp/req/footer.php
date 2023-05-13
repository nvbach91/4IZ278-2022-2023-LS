<footer id='footer'>
    <div v-if='data&&data.message' class="message">{{data.message}}</div>
    <div v-if='data' class="footer">
        <div>
            <h4>We're open</h4>
            <p>{{data.hours}}</p>
            <h4>Address</h4>
            <p>{{data.address}}</p>
        </div>
        <div>
            <h4>Contact us</h4>
            <p>{{data.email}}</p>
            <p>{{data.phone}}</p>
        </div>
    </div>
</footer>

<script>
    Vue.createApp({
        data() {
            return {
                data: '',
            };
        },
        mounted() {
            axios.get(API_URL + '/getCafeData').then(response => {
                this.data = response.data;
            });
        },
    }).mount("#footer");
</script>