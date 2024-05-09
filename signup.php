<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facebook - Log in or Sign up</title>
    <link rel="shortcut icon" type="png" href="pics/logo.png">
    <link rel="stylesheet" href="signup.css">
</head>
<body>
    <div class="box">
        <div class="title-box">
            <img src="pics/facebooklogo.png" alt="Facebook">
            <p>Connect with friends and the world<br>around you on Facebook.</p>
        </div>
        <div class="form-box">
            <form id="loginForm">
                <input type="text" placeholder="Email or phone number" name="email" id="loginemail" required>
                <input type="password" placeholder="Password" name="password" id="loginpassword"required>
                <img src="pics/show.png" alt="" class="showicon" id="eyeicon">
                <button type="submit" class="loginbtn">Log In</button>
                <a href="#">Forgot Password?</a>
            </form>
            <hr>
            <div class="create-btn">
                <button id="openModalBtn">Create new account</button>
            </div>
        </div>
    </div>
    <div id="signupModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="signupForm">
                <h2 class="first-title">Sign Up</h2>
                <p class="first_sub_title" id="sub_title">It's quick and easy.</p>
                <hr>
                <div class="input">
                    <input type="text" name="firstname" placeholder="First name" class="first_name" id="firstname" required>
                    <input type="text" name="lastname" placeholder="Last name" class="last_name" id="lasname" required>
                    <input type="text" name="email" placeholder="Email or phone number" class="email" id="signupemail" required>
                    <input type="password" name="password" placeholder="Password" class="password" id="signuppassword" required>
                </div>
                <p class="sub_title_2" id="sub_title">Date of Birth</p>
                <select name="month" id="month">
                    <option value="Jan">Jan</option>
                    <option value="Feb">Feb</option>
                    <option value="Mar">Mar</option>
                    <option value="Apr">Apr</option>
                    <option value="May">May</option>
                    <option value="Jun">Jun</option>
                    <option value="Jul">Jul</option>
                    <option value="Aug">Aug</option>
                    <option value="Sep">Sep</option>
                    <option value="Oct">Oct</option>
                    <option value="Nov">Nov</option>
                    <option value="Dec">Dec</option>
                </select>
                <select name="day" id="day">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>
                </select>
                <select name="year" id="year">
                    <option value="1954">1954</option>
                    <option value="1955">1955</option>
                    <option value="1956">1956</option>
                    <option value="1957">1957</option>
                    <option value="1958">1958</option>
                    <option value="1959">1959</option>
                    <option value="1960">1960</option>
                    <option value="1961">1961</option>
                    <option value="1962">1962</option>
                    <option value="1963">1963</option>
                    <option value="1964">1964</option>
                    <option value="1965">1965</option>
                    <option value="1966">1966</option>
                    <option value="1967">1967</option>
                    <option value="1968">1968</option>
                    <option value="1969">1969</option>
                    <option value="1970">1970</option>
                    <option value="1971">1971</option>
                    <option value="1972">1972</option>
                    <option value="1973">1973</option>
                    <option value="1974">1974</option>
                    <option value="1975">1975</option>
                    <option value="1976">1976</option>
                    <option value="1977">1977</option>
                    <option value="1978">1978</option>
                    <option value="1979">1979</option>
                    <option value="1980">1980</option>
                    <option value="1981">1981</option>
                    <option value="1982">1982</option>
                    <option value="1983">1983</option>
                    <option value="1984">1984</option>
                    <option value="1985">1985</option>
                    <option value="1986">1986</option>
                    <option value="1987">1987</option>
                    <option value="1988">1988</option>
                    <option value="1989">1989</option>
                    <option value="1990">1990</option>
                    <option value="1991">1991</option>
                    <option value="1992">1992</option>
                    <option value="1993">1993</option>
                    <option value="1994">1994</option>
                    <option value="1995">1995</option>
                    <option value="1996">1996</option>
                    <option value="1997">1997</option>
                    <option value="1998">1998</option>
                    <option value="1999">1999</option>
                    <option value="2000">2000</option>
                    <option value="2001">2001</option>
                    <option value="2002">2002</option>
                    <option value="2003">2003</option>
                    <option value="2004">2004</option>
                    <option value="2005">2005</option>
                    <option value="2006">2006</option>
                    <option value="2007">2007</option>
                    <option value="2008">2008</option>
                    <option value="2009">2009</option>
                    <option value="2010">2010</option>
                    <option value="2011">2011</option>
                    <option value="2012">2012</option>
                    <option value="2013">2013</option>
                    <option value="2014">2014</option>
                    <option value="2015">2015</option>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                </select>
                <p class="sub_title_3" id="sub_title">Gender</p>
                <div class="female" id="female">
                    <label for="female">Female</label>
                    <input type="radio" name="gender" value="Female">
                </div>
                <div class="male" id="male">
                    <label for="male">Male</label>
                    <input type="radio" name="gender" value="Male">
                </div>
                <div class="other" id="other">
                    <label for="other">Other</label>
                    <input type="radio" name="gender" value="Other">
                </div>
                <p class="sub_title_4">
                    By clicking Sign Up, you agree to our <a href="#">Terms, Privacy Policy</a> and <a href="">Cookies Policy</a>. You may receive SMS Notifications from us and can opt out any time.
                </p>
                <input type="submit" value="Sign up" class="submit">
            </form>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="signup.js"></script>
</body>
</html>