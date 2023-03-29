const coordinatesInputs = [
    document.getElementById('school-h'),
    document.getElementById('school-w')
];
const addressInput = document.getElementById('school-address');
const submitButton = document.getElementById('submitButton');

let timeOut = 10,
    address = null;

ymaps.ready(init);

function init() {
    addressInput.addEventListener('input', (e) => {
        address = addressInput.value;
        timeOut = 10;
        console.log(address);
    });

    setInterval((e) => {
        if (timeOut > 0) {
            timeOut--;
            if (address) {
                submitButton.setAttribute('disabled', 'disabled');
            }
        } else if (address) {
            getCoordinates();
            address = null;
        }
    }, 100);
}

function getCoordinates() {
    ymaps.geocode(address, {
        results: 1
    }).then(function (res) {
        const coordinates = res.geoObjects.get(0).geometry.getCoordinates();
        submitButton.removeAttribute('disabled');
        console.log(coordinates);
        coordinatesInputs[0].setAttribute('value', coordinates[0]);
        coordinatesInputs[1].setAttribute('value', coordinates[1]);
    });
}