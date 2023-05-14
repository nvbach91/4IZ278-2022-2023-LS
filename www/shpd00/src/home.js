container = document.getElementById('form-div');
container.innerHTML = `
                        <form>
                            <div>
                                <label>username</label>
                                <input name="username" type="text">
                            </div>
                            <div>
                                <label >password</label>
                                <input name="password" type="password">
                            </div>
                            <button>submit</button>
                        </form>
                    `;
    //const logInButton = document.createElement("button");
    // logInButton.setAttribute("class", "log_in_button");
    // logInButton.setAttribute("part", "log_in_button");
    // logInButton.innerText = 'Log in'
    // logInButton.addEventListener("click", login )
    // container.appendChild(logInButton);