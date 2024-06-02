

if (typeof userInfo === 'undefined') {
    // If not defined, define it
    const userInfo = JSON.parse(localStorage.getItem('userInfo'));


    const FnameElement = document.getElementById('FnInput');
    const LnameElement = document.getElementById('LnInput');
    const PnumberElement = document.getElementById('NumberInput');
    const emailElement = document.getElementById('EmailInput');
    const usernameElement = document.getElementById('UsernameInput');
    const profilePhotoElement = document.getElementById('profilePhoto');

    const sexSelectElement = document.getElementById('sexSelect');

    // Get the date of birth
    const dobDayElement = document.getElementById('dob-day');
    const dobMonthElement = document.getElementById('dob-month');
    const dobYearElement = document.getElementById('dob-year');

    // const dob = `${dobYearElement.value}-${dobMonthElement.value}-${dobDayElement.value}`;
    // const sex = sexSelectElement.value;



    if (userInfo && userInfo.length === 1) {
        const Fname = userInfo[0].first_name;
        const Lname = userInfo[0].last_name;
        const Pnumber = userInfo[0].phone_number;
        const email = userInfo[0].email;
        const username = userInfo[0].username;
        const profilePhoto = userInfo[0].img;

        // Your code to make something...


        function setInpValue() {

            FnameElement.value = Fname;
            LnameElement.value = Lname;
            PnumberElement.value = Pnumber;
            emailElement.value = email;
            usernameElement.value = username;
            profilePhotoElement.src = profilePhoto;
        }

        setTimeout(setInpValue, 200)
    }









    function saveChangesClick(event) {

        dob = `${dobYearElement.value}-${dobMonthElement.value}-${dobDayElement.value}`;
        const sex = sexSelectElement.value;
        console.log('save click');


        axios.post('./php/user/update-user-info.php', {
            username: usernameElement.value,
            first_name: FnameElement.value,
            last_name: LnameElement.value,
            phone_number: parseInt(PnumberElement.value),
            img: profilePhotoElement.src,
            sex: sex,
            birthday: dob


        })
            .then(response => {
                if (response.data.success) {
                    // Display success message



                    console.log("User Info Updated successfully.", response.data.customer);

                    // Update userInfo in session storage
                    const updatedUserInfo = {
                        username: usernameElement.value,
                        first_name: FnameElement.value,
                        last_name: LnameElement.value,
                        phone_number: parseInt(PnumberElement.value),
                        email: emailElement.value,
                        img: profilePhotoElement.src,
                        sex: sex,
                        birthday: dob
                    };
                    localStorage.setItem('userInfo', JSON.stringify([updatedUserInfo]));


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


                    console.error("Error Updating  userInfo:", response.data.error);
                }
            })
            .catch(error => {
                // Display error message


                console.error("Error:", error);
            });




    }




    function changePassClick(event) {

        const changePassContainer = document.querySelector('.change-pass-container');
        changePassContainer.classList.toggle('hide');

        console.log('okey kayo');

    }











} else {
    // If already defined, log a message
    console.log('userInfo is already defined.');





}



function addFileXClick(event) {

    document.querySelector('.add-file-url-overlay').classList.add('hide');

}


function showFileAdd(event) {

    document.querySelector('.add-file-url-overlay').classList.remove('hide');

}


function addFileCLick(event) {

    const ImgUrlHolder = document.getElementById('img-url-holder');


    const profilePhotoElement = document.getElementById('profilePhoto');






    profilePhotoElement.src = ImgUrlHolder.value;

    addFileXClick();












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



function PasswordSaveClick(event) {
    event.preventDefault(); // Prevent form submission
    const currentPass = document.getElementById('currentPass').value;
    const newPass = document.getElementById('newPass').value;
    const confirmPass = document.getElementById('confirmPass').value;

    // Validate if new password matches the confirmation
    if (newPass !== confirmPass) {
        alert("New password and confirmation password don't match.");
        return;
    }

    // Prepare data for POST request
    const data = {
        current_password: currentPass,
        new_password: newPass,
        confirm_password: confirmPass
    };

    // Send POST request using Axios
    axios.post('./php/user/update-user-pass.php', data)
        .then(response => {
            console.log(response.data);
            alert(response.data.message);
        })
        .catch(error => {
            console.error(error);
            alert("Error updating password. Please try again.");
        });

} 
