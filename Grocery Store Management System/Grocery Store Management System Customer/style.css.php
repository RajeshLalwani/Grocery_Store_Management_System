body{
    padding:0px;
    margin:0px;
    font-family: laisha;
  } 

  .navbar{
    
    display: flex;
    align-items: center;
    justify-content:space-evenly ;
    border: 1px #d7c49eff solid;
    background:linear-gradient(to left,rgb(175, 98, 59),beige);
    position: fixed;  
    width: 100%;   
}
.logo{
  text-shadow:  -4px -4px 10px  rgb(78, 74, 74);
  font-size: 20px;
}

.navbar:hover{
    box-shadow:  -2px -2px 10px ;
}

.nav-element{
  margin-left: 500px;
  
}

/*navbar anchor tag css*/
a{
  text-decoration: none;
  color: white;
  float: right;
  border-radius: 20px;
  
}

a:hover{
    box-shadow: 0px 0px 3px;
    
}

 
/* main page css image and background*/
.main{
    background: linear-gradient(to left,rgb(175, 98, 59),beige);
    height: 750px;
    display: flex;
    align-content: center;
    align-items: center;
    justify-content: space-evenly;
    box-shadow:  -2px -2px 10px ;
          
}


.image{  
     float: right;
     margin-top: 20px;   
}

.main h1{
    font-family: 'Times New Roman', Times, serif;
    font-weight: 100;
    font-size: 60px;
    text-shadow: -4px -4px 20px rgb(71, 67, 67);
    
}

/*display box on home page (main2) */
.display-box{
  height: 400px;
  background: linear-gradient(to left,#ffffff,#ffffff);
  display: flex;
  justify-content: center;
  align-items: center;
  justify-content: space-evenly;
  
}

.box{
  height: 300 px;
  width: 200px;
  padding: 5px;
  font-family: laisha;
  font-style: italic;
  border:0.5px black solid;
  border-radius: 12%;
  text-align:center;
  box-shadow: 2px 2px 15px ;
}


.box img{
  height: 200px;
  width: 200px;  
}

.display-box1{
  background: linear-gradient(to bottom,rgb(199, 176, 135),rgb(67, 66, 66));
}

.display-box2{
  background: linear-gradient(to bottom,rgb(159, 199, 135),rgb(67, 66, 66));
}

.display-box3{
  background: linear-gradient(to bottom,rgb(199, 189, 135),rgb(67, 66, 66));
}

.display-box4{
  background: linear-gradient(to bottom,rgb(202, 162, 196),rgb(67, 66, 66));
}

/*watches categories*/
.categories{
  display: flex;
  justify-content: center;
  align-items: center;
  justify-content: space-evenly;
  background: linear-gradient(to left,#ffffff,#ffffff);
 
}

.cate{
  height: 300px;
  width: 200px;
  border-radius:  15%;
  background-color: rgb(222, 201, 201);
  padding: 20px;
}

.cate img{
  height: 250px;
  width: 200px;
  border-radius: 10%; 
  box-shadow: -2px -2px 30px rgb(154, 83, 83);
  margin-bottom: 10%;
  
}

/*featured products*/
.feature-heading{
  margin-top: 100px;
}
.featured-product{
  
  display: flex;
  justify-content: center;
  align-items: center;
  justify-content: space-evenly;
  background: linear-gradient(to left,#ffffff,#ffffff);
  flex-wrap: wrap;
  padding: 20px;
  margin-top: 50px;
  
}
.feature1{
  height: 350px;
  width: 250px;
  border: 0px black solid;
  padding: 10px;
  border-radius: 20px;
  padding: 30px;
  
}
.feature1 a{
  color: black;
  margin-bottom: 50px;
  border:1px black solid;
  background-color: white;
  padding: 3px;
  margin-right:5px;
}
.feature1 img{
  background:linear-gradient( antiquewhite,white);
  border-radius: 10%;
  height: 200px;
  width: 200px;
  padding-top: 10px; 
}
.cost{
  border: 0.5px black solid;
  padding: 4px;
  background-color: aliceblue;
   border-radius: 5px;
}

.add-to-cart{
  margin-top: 40px;
  background-color: black;
  padding: 20px;
}

/*footer*/
.footer{
  height: 550px;
  background:linear-gradient(to top, rgb(200, 160, 160),beige);
 
}
.foot-container{
  display: flex;
  justify-content: center;
  align-items: center;
  justify-content: space-evenly;
}
.foot{
  height:  60%;
  color:rgb(69, 65, 65);
  display: flex;
  flex-direction: column;
}
.foot a{
  color:rgb(69, 65, 65);
}

.foot img{
  height: 40px;
 margin-top: 10px;

}
.copy-right{
  display: flex;
  justify-content: center;
}
.copyright{
  height: 15px; 
  margin-top: 200px;
}

/*Sign in page*/
.signin-container{
  background-color: bisque;
  height: 740px;
  display: flex;
  justify-content: center;
  align-items: center;
}

/*sign in form*/
.signin-form{
 height: 550px;
  border: 2px white solid;
  border-radius: 10px;
  padding: 50px;
  background-color:rgb(216, 195, 195);
  color: black;
  font-weight: 500;
  display: flex;
  flex-direction: column;
  justify-content: center;
  width: 270px;
  border: none;
  outline: none;
  
}

.signin-form:hover{
  box-shadow: -2px -2px 10px rgb(195, 142, 142);
}

.signin-form input{
  border-radius: 10px;
  padding: 5px;
  border: none;
  outline: none;
  height: 25px;

}
button{
  width: 100px;
  padding: 5px;
  border: none;
  border-radius: 10px;
  font-weight: 600;
}
button:hover{
  background-color: black;
  color: white;
}

/*left side of login and signin*/
.side-left{
  height: 700px;
  width: 700px;
  background-color: black;
  color: white;
  border-radius: 10px;
  display: flex;
  justify-content: center;
  align-items: center;
  
}
.side-left:hover{
  box-shadow: -2px -2px 10px rgb(29, 26, 26);
 
}


/*right side of login and signin*/
.side-right{
  height: 700px;
  width: 700px;
  background-color: rgb(134, 129, 129);
  color: white;
  border-radius: 10px;
  display: flex;
  justify-content: center;
  align-items: center;
  justify-content: space-around;
}
.side-right:hover{
  box-shadow: -2px -2px 10px rgb(125, 111, 111);
}
.side-right img{
  height: 80%;
  border-radius: 20px;
  size: cover;
  margin: 2%  ;
}
.side-right p{
  font-size: 30px;
  margin: 2%;
  text-shadow: -2px -2px  10px rgb(0, 0, 0);
}
.side-right p{
  text-shadow: -2px -2px  10px rgb(15, 1, 1);
}

/*login form*/
.login-container{
  background-color: bisque;
  height: 740px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.login-form{
  border: 2px white solid;
  border-radius: 10px;
  padding: 50px;
  background-color:rgb(216, 195, 195);
  color: black;
  font-weight: 500;
  display: flex;
  flex-direction: column;
  justify-content: center;
  width: 270px;
  border: none;
  outline: none;
}

.login-form:hover{
  box-shadow: -2px -2px 10px rgb(195, 142, 142);
}

.login-form input{
  border-radius: 10px;
  padding: 2px;
  border: none;
  outline: none;
  height: 25px;
}
.loginbtn{
  width: 260px;
}
.signin-btn{
  background-color: white;
  color: black;
  font-size: 13.5px;
  font-weight: 600;
  font-family: arial;
  padding: 5px;
  width: 260px;
  border: none;
  border-radius: 10px;
}
.signin-btn:hover{
  background-color:black;
  color: white;

}
/*add to cart page*/
.cart-container{
  background: linear-gradient(to left,#ffffff,#ffffff);
  height: 700px;
  display: flex;
  flex-direction:column;
  align-items: center;
  
}
.cart{
  height: 200px;
  width: 1200px;
  background:linear-gradient(to top, rgb(200, 160, 160),beige);
  margin-top: 50px;
  border-radius: 10px;
  display: flex;
  justify-content: space-around;
  align-items: center;
}
.cart img{
  height: 100px;
  width: 100px;
}
/*cart buttons*/
.remove{
  font-size: 20px;
  border:0.5px black solid;
  padding: 5px;
  background-color: black;
  }
.remove:hover{
  box-shadow: -2px -2px 10px black;

}
.add-to-cart{
  font-size: 20px;
  border:0.5px black solid;
  padding: 5px;
  background-color: black;
  margin-bottom: 45px;
}
.add-to-cart:hover{
  box-shadow: -2px -2px 10px black;

}

/*categories men and women*/
.categorie-header{
  text-align: center;
  margin: auto;
  margin-top: 3%;

  background-image: linear-gradient(to right, #969090, #740909);
  background-clip: text;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  font-size: 2rem;
 /* font-weight: bold;*/
  text-align: center;
  letter-spacing: 3px;
}

.dash-container{
  background-color: antiquewhite;
  height: 680px;
}
.nav{
  height: 75px;
  background-color: azure;
  display: flex;
  justify-content: center;
  align-items: center;
  justify-content: space-evenly ;
}
.logout{
  margin-left: 70%;
  float: right;
  text-decoration: none;
  color: black;
  font-size: 22px;
}
.logout:hover{
  text-shadow: -2px -2px 10px black ;
}

.dash-element{
  background-color:wheat;
  height: 600px;
  width: 200px;
  display: flex;
  align-items: center;
  flex-direction: column;
  justify-content: space-evenly;
  
}
.dash-element a{
  text-decoration: none;
  color: black;
  font-size: 22px;

}

/**featured products admin**/
.form{
  height: 750px;
  background-color: rgb(221, 205, 205);
  display: flex;
  justify-content: center;
  align-items: center;
}
form{
  height: 400px;
  width: 300px;
  border: 2px black solid;
  border-radius: 7px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  
}
label{
  font-size: 20px;
}
input{
  border-radius: 3px;
  border: none;
  height: 30px;
}
