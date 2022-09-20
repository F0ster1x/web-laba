let Form1 = document.getElementById('form1');
Form1.addEventListener('submit', function (event) {
    event.preventDefault();
    if (msg.length != 0) {
        alert(msg);
    } else {
        console.log(Form1);
        let registerForm = new FormData(Form1);
        console.log(registerForm);
        fetch('/addScreenshot', {
                method: 'POST',
                body: registerForm
            }
        )
            .then(response => response.json())
            .then((result) => {
                if (result.errors) {
                    alert('Такой email уже существует !');
                    //вывод ошибок валидации на форму
                } else {
                    alert('Вы Добавили!');
                    closeModal_Reg();
                    //успешная регистрация, обновляем страницу
                }
            })
            .catch(error => console.log(error));


    }
    msg = '';
});