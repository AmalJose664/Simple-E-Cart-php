let element = document.querySelector('.mouse');

window.addEventListener('mousemove', (e) => {
    
    xValue = e.clientX;
    yValue = e.clientY;
    element.style.transform = `translateX(calc(${xValue}px - 7px)) translateY(calc(${yValue}px - 4px))`;

});


let uname = document.getElementById('username')
const email = document.getElementById('email');
const pass = document.getElementById('pass');

const btn = document.getElementById('accessbtn')
const result = document.getElementById('result')

//console.log(uname,email,pass);
let i = 0;

const debugMode=false;
const params = new URLSearchParams(window.location.search);
const word = params.get('admin');
function access() {
    
    let action ='signup';
    if(!uname){
        
        action ="login"
    }
    
    if(!debugMode){
        fetch('loginconnect.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ name: uname ? uname.value : '', email: email.value, pass: pass.value, action: action })
        })
            .then(response => response.json())
            .then(data => { // Should log the response object

                if (!data.status) {
                    i++
                    result.innerHTML = data.message + " " + i;
                    result.classList.toggle('anime');
                    setTimeout(() => {
                        result.classList.toggle('anime');
                    }, 700)

                } else {
                    if(word){
                        window.location="../adminF/"
                    }else{
                        window.location = data.next;
                    }
                    
                }
                //console.log("executed");


            })
            .catch(error => console.error('Error:', error));
    }else{
        const formData = document.forms[0];
        formData.action="loginconnect.php"
        formData.method="post";
        
        

        newInput = `<input name = 'action' value='${action}' hidden>
        <input name = 'email' value='${email.value}' hidden>
        <input name = 'password' value='${pass.value}' hidden>`;
        if (uname) {
            newInput += `<input name = 'username' value='${uname.value}' hidden>`
        }

        formData.innerHTML=newInput;
        formData.submit();
        console.log(formData);
        
    }

}
let form = document.querySelector('.form')
form.addEventListener('submit',(event)=>{
    
    
    event.preventDefault()
    if (form.checkValidity()){
        access();
    }else{
        form.reportValidity();
    }
})