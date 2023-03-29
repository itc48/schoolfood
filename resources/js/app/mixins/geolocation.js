export default {
    methods: {
        geolocationHandler(event) {
            switch (event.state) {
                case 'granted':
                    console.debug(event.state);
                    navigator.geolocation.getCurrentPosition((e) => {
                        this.$store.commit('setCoordinates', e.coords)
                        console.debug('Доступ получен')
                        console.debug(e.coords)
                    })
                    break;
                case 'prompt':
                    console.debug(event.state);
                    break;
                case 'denied':
                    this.$store.commit('setErrorText', 'В целях безопасности, необходимо разрешить доступ к геолокации в настройках Вашего устройства')
                    console.debug(event.state);
                    break;
            }
        }
    }
}