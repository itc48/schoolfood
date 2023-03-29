export default function geolocation({next, store}) {
    if (!store.getters.getCoordinates) {
        console.debug('%c Middleware deny', 'background: #222; color: red');
        return next({
            name: 'ReviewIndex'
        })
    }

    return next()
}