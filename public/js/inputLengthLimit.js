document.addEventListener('DOMContentLoaded', () => {
    const inputs = [
        document.getElementById('school-h'),
        document.getElementById('school-w'),
    ];

    inputs.forEach((input) => {
        input.addEventListener('change',  sliceInput)
        input.addEventListener('input',  sliceInput)
    })
})

function sliceInput(e) {
    if (e.target.value.length > 9) {
        e.target.value = e.target.value.substring(0, 9)
    }
}