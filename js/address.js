function editAddressClick() {
    var overlay = document.querySelector('.address-overlay');
    var body = document.querySelector('body');
    overlay.classList.toggle('hide');
    body.classList.toggle('no-scroll');
}



function addAddress() {
    const province = document.getElementById('ProvinceInp').value;
    const townOrCity = document.getElementById('TownOrCityInp').value;
    const barangay = document.getElementById('BarangayInp').value;
    const zipCode = document.getElementById('zipCodeInp').value;
    const landmark = document.getElementById('LandmarkInp').value;





    // Now you can use these variables as needed, for example:
    console.log('Province:', province);
    console.log('Town or City:', townOrCity);
    console.log('Barangay:', barangay);
    console.log('Zip Code:', zipCode);
    console.log('Landmark:', landmark);







    axios.post('./php/user/update-address.php', {
        province: province,
        townOrCity: townOrCity,
        barangay: barangay,
        zipCode: zipCode,
        landmark: landmark




    })
        .then(response => {
            if (response.data.success) {
                // Display success message



                console.log("User Address Updated successfully.", response.data.customer);

                // Update userInfo in session storage
                const updatedAddress = {
                    province: province,
                    townOrCity: townOrCity,
                    barangay: barangay,
                    zipCode: zipCode,
                    landmark: landmark
                };
                localStorage.setItem('userAddress', JSON.stringify([updatedAddress]));


                const popUpOverlay = document.querySelector('.pop-up-overlay');
                const popUpSucess = document.querySelector('.pop-up-sucess')

                popUpOverlay.classList.remove('hide')
                popUpSucess.classList.remove('hide')



            } else {
                // Display error message


                const popUpOverlay = document.querySelector('.pop-up-overlay');
                const popUpFailed = document.querySelector('.pop-up-failed')

                popUpOverlay.classList.remove('hide')
                popUpFailed.classList.remove('hide')


                console.error("Error Updating  Address:", response.data.error);
            }
        })
        .catch(error => {
            // Display error message


            const popUpOverlay = document.querySelector('.pop-up-overlay');
            const popUpFailed = document.querySelector('.pop-up-failed')

            popUpOverlay.classList.remove('hide')
            popUpFailed.classList.remove('hide')


        });


    editAddressClick();





}

function failedXClick(){

    const popUpOverlay = document.querySelector('.pop-up-overlay');
    const popUpFailed = document.querySelector('.pop-up-failed')

    popUpOverlay.classList.add('hide')
    popUpFailed.classList.add('hide')

    console.log("ahahah");
}



function successXClick() {

    const popUpOverlay = document.querySelector('.pop-up-overlay');
    const popUpSucess = document.querySelector('.pop-up-sucess')

    popUpOverlay.classList.add('hide')
    popUpSucess.classList.add('hide')

}
function failedXClick() {

    const popUpOverlay = document.querySelector('.pop-up-overlay');
    const popUpSucess = document.querySelector('.pop-up-sucess')

    popUpOverlay.classList.remove('hide')
    popUpSucess.classList.remove('hide')

}