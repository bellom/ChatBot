<?php
  $conn = new PDO("mysql:host=". "localhost". ";dbname=". "hng_fun", "root", "");
  $result = $conn->query("Select * from secret_word LIMIT 1");
  $result = $result->fetch(PDO::FETCH_ASSOC);
  $secret_word = $result['secret_word'];

  $result2 = $conn->query("Select * from interns_data where username = 'bellom'");
  $user = $result2->fetch(PDO::FETCH_ASSOC);
  
  $username = $user['username'];
  $name = $user['name'];
  $image_filename = $user['image_filename'];

   if(isset($_GET['answer'])){
        require_once '../../config.php';
    
        
       try {
		    $conn = new PDO("mysql:host=". DB_HOST. ";dbname=". DB_DATABASE , DB_USER, DB_PASSWORD);
		} catch (PDOException $pe) {
		    die("Could not connect to the database " . DB_DATABASE . ": " . $pe->getMessage());
        }
        
		
		
		$question = htmlspecialchars($_GET['question']);
		$answer = htmlspecialchars($_GET['answer']);
		$params = array(':question' => $question, ':answer' => $answer);
		$sql = 'INSERT INTO chatbot ( question, answer )
		      VALUES (:question, :answer);';
        $result;
		try {
		    $q = $conn->prepare($sql);
		    if ($q->execute($params) == true) {
		        $result = [
		            'result' => "Thanks for training me, I'm feeling lucky and smart'"
		        ];
		    };
		} catch (PDOException $e) {
			$result = [
			    'result'    => "Error! I couldn't recieve training, my bad (:"
            ];
		    throw $e;
        }
        
        echo json_encode($result);
        return;
	}else if(isset($_GET['question'])){
        require_once '../../config.php';
        
        try {
		    $conn = new PDO("mysql:host=". DB_HOST. ";dbname=". DB_DATABASE , DB_USER, DB_PASSWORD);
		} catch (PDOException $pe) {
		    die("Could not connect to the database " . DB_DATABASE . ": " . $pe->getMessage());
        }
        
	   	$question = htmlspecialchars($_GET['question']);
		$result = $conn->query("SELECT answer FROM chatbot WHERE question LIKE '%{$question}%' ORDER BY rand() LIMIT 1");
		$result = $result->fetch(PDO::FETCH_OBJ);
        $answer = $result->answer;
        
        $data = ['result'=>$answer];
        
		
		header('Content-Type: application/json');
		echo json_encode($data);
		return;
    }
    global $secret_word;
    $query = $conn->query("Select * from secret_word LIMIT 1");
    $result = $query->fetch(PDO::FETCH_OBJ);
    $secret_word = $result->secret_word;
    $sql = $conn->query("Select * from interns_data where username = 'bellom' LIMIT 1");
    $user = $sql->fetch(PDO::FETCH_OBJ);
    $name = $user->name;
    
	?> 




<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Bellom Sean  | Web Developer</title>
		<link href="https://fonts.googleapis.com/css?family=Changa+One|Open+Sans:400,400i,700,700i,800" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        
        <style>
             /************************************
 GENERAL
 ************************************/
            
            body {
                font-family:'open sans', san serif;
            }


             #wrapper {
                max-width: 940px;
                margin: 0 auto;
                padding: 0 5%;
            }

             a {
                text-decoration:none;
            }

            img {
                max-width: 100%;
            }

            h3 {
                margin: 0 0 1em 0;
            }

             /************************************
             HEADING
             ************************************/
             header {
                 float: left;
                 margin: 0 0 30px 0;
                 padding: 5px 0 0 0;
                 width: 100%;
             }


             #logo {
                text-align: center;
                margin: 0;
            }

            h1 {
                font-family: 'Changa One', sans-serif;
                margin: 15px 0;
                font-size: 1.75em;
                font-weight: normal;
                line-height: 0.8em;
            }

            h2 {
                font-size: 0.75em;
                margin: -5px 0 0;
                font-weight: normal;
            }
            /************************************
            FO0TER
            ************************************/
            footer {	
                font-size: 0.75em;
                text-align:center;
                clear:both;
                padding-top:50px;
                color:#ccc;
            }

            .social-icon {
                width: 20px;
                height: 20px;
                margin: 0 5px;
            }

            /************************************
            PAGE: ABOUT
            ************************************/
            .profile-photo {
                display: block;
                max-width: 150px;
                margin: 0 auto 30px;
                border-radius: 20%;

            }

            /************************************
            COLORS
            ************************************/

             /* site body */

    
             
            body {
                background-color:#fff;
                color:#999;
            }

            /*green header*/
            header {
                background: #6ab47b;
                border-color: #599a68;
                text-align: center;
            }

            /*logo text*/
            h1, h2 {
                color: #fff;
            }

            /*links*/
            a {
                color: #6ab47b;
            }

            body {
                font-family: Arial, Helvetica, sans-serif;
            }

            td {
                font-family: Arial, Helvetica, sans-serif;
            }

            th {
                font-family: Arial, Helvetica, sans-serif;
            }
            
            @media screen and (min-width: 480px) {
	
            /************************************
            TWO COLUMN LAYOUT
            ************************************/

            #primary {
                width: 50%;
                float: left;
            }
            #secondary {
                width: 40%;
                float: right;
            }

            /************************************
            PAGE: ABOUT
            ************************************/
            .profile-photo {
                float: left;
                margin: 0 5% 80px 0;
            }

        }
            @media screen and (min-width: 660px) {
                /************************************
                HEADER 	
                ************************************/
                .chatbox {
                    float: none;
                    width: 50%;
                }
                #logo {
                    float: left;
                    margin-left: 5%;
                    text-align: left;
                    width: 45%;
                }

                h1 {
                    font-size: 2.5em;
                }


                h2 {
                    font-size: 0.85em;
                    margin-bottom: 20px;
                    text-align: left;
                }

                header {
                    border-bottom: 5px solid #599a68;
                    margin-bottom: 60px;
                }


             }
            
            /* chatbox style */
            
            
        #big-container{
          width: 100%;
          display: flex;
          flex-wrap: wrap;
          justify-content: space-between;
        }
        
        #chatborder{
            font-size:13px;
            margin-top:10px;
            padding: 10px;
            border: 1px solid #eee;
            background-color: whitesmoke;
            width: 320px;
            height: 342px;
            overflow-y: scroll;
        }
        .chatlog{
            display: block;
            clear: both;
        }    
        #msg-box{
            width:60%;
            background-color: #e7f8ec;
            float:right;
            padding: 5px 2px;
            text-align:right;
        }
        #reply-box{
            width:60%;
            background-color: #e7f8ec;
            float: left;
            padding: 5px 2px;
        }
        
        input {
            height: 35px;
            width: 275px
        }

        </style>
        
	</head>
	<body>
		<header>
			<a href="index.html" id="logo">
				<h1><?php echo $name; ?></h1>
				<h2>Web Developer</h2>
			</a>

		</header>
		<div id="wrapper">
			<section>
				
				<img src="<?php echo $image_filename?>" alt="Photogragh of Bellom Sean"  class="profile-photo">
				<h3>About</h3>
				<p>Hi, I'm Bellom Sean! This is my design portfolio where i share all of my design work.</p>
				<p>If you like to follow me on facebook, my facebook name is <a href="http://facebook.com/oluwadamilare.bellomsean">bellom sean</a>.</p>							
			</section>
            
<!--      type your chatbot code below -->
        <div id="big-container">
            <div id='bodybox'>
                <div id='chatborder'>

                </div>
                <div>
                
                <input v-on:keyup.enter="sendMsg" v-model="message" type="text" name="chat" id="chatbox" placeholder="Type your message here..." />
                <button style="float: right" sv-on:click="sendMsg"><i class="fa fa-send-o fa-2x"></i></button>
                </div>
                
            </div>
        </div>
            
            
        
            
			<footer>
				<a href="http://facebook.com/oluwadamilare.bellomsean"><img src="http://res.cloudinary.com/hng-bellom/image/upload/v1524171059/image6.png" alt="Facebook Logo" class="social-icon"></a>
				<p>&copy; 2018 Bellom Sean.</p>
			</footer>
		</div>
        
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.0"></script>
        <script>
            new Vue({
                el: '#bodybox',
                data: {
                    message: '',
                    reply: '',
                },
                created: function(){
                    var msg = 'Hi, thanks for showing up.<br> To get a list of things I  can do apart from the usual chat, type `help`.';                    
                    this.reply = msg;
                    this.sendReply(this.reply);
                },
                methods: {
                    sendMsg: function(){
                        $('#chatborder').append(this.makeMsg(this.message));
                        this.thinkOn(this.message);
                        this.message = '';
                    },
                    thinkOn: function(msg){
                        msg = msg.trim().toLowerCase();
                        var keyword = msg.split(' ')[0];
                        if(keyword == 'help'){
                            var helpMsg = ` I can do the following: <br> 
                                            Type "aboutbot" - I'll tell you about me.<br> 
                                            Type "train" - #train [question] [answer] [password].`;
                                this.sendReply(helpMsg);
                        }else if(keyword == 'aboutbot'){
                            this.sendReply('Bellom\'s Bot')
                        }else if(keyword == '#train'){
                            this.trainMe(msg);
                        }else{
                            this.getReplyFromDb(msg);
                        }
                        return;
                    },
                    getReplyFromDb: function(question){
                        this.$http.get('profiles/bellom.php?question='+question)
                                .then(response => {
                                    var trainMeMsg = 'I cannot find you a correct answer, but you can train me via: <br> #train [question] [answer] [password]';
                                    this.reply = (response.data != null) ? response.data.result : trainMeMsg;
                                    this.sendReply(this.reply);
                                }, response => {
                                    this.sendReply('Hello, remember am just a bot so i cant give answer to all questions but you can train me');
                                });
                    },
                    makeMsg: function(message){
                        return `<div class="chatlog"><p id="msg-box">${message} </p></div>`;
                    },
                    makeReply: function(message){
                        return `<div class="chatlog"><p id="reply-box">${message} </p></div>`;                        
                    },
                    sendReply: function(message){
                        $('#chatborder').append(this.makeReply(message));
                        this.scrollDown();
                    },
                    trainMe: function(command){
                        var args = command.match(/\[(.*?)\] \[(.*?)\] \[(.*?)\]/);
                        if(!args || !args[3]){
                            var msg = "Can't recieve training like that, <br> follow the correct syntax #train [question] [answer] [password]";
                            this.sendReply(msg);
                            return;
                        }
                        var password = args[3];
                        if(password != 'password'){
                            var msg = 'Invalid passowrd for training me. <br> Enter a valid password.';
                            this.sendReply(msg);
                            return;
                        }
                        this.$http.get('profiles/donsamuel.php?question='+args[1]+'&'+'answer='+args[2])
                                .then(response => {
                                    // get body data
                                    this.reply = (response.data.result != null) ? response.data.result : 'Unable to recieve training';
                                    this.sendReply(this.reply);
                                }, response => {
                                    // error callback
                                    this.sendReply('Something went wrong, please try again later');
                                });
                    },
                    scrollDown: function(){
                        var chatWrapper = $('#chatborder');
                        chatWrapper.animate({ scrollTop:  chatWrapper.prop("scrollHeight") -  chatWrapper.height() }, 500);
                    }
                }
            });
        </script>
        
        
        
	</body>
</html>

<!--my image on clound-->
<!--<img src="http://res.cloudinary.com/hng-bellom/image/upload/v1524016064/bellom1.jpg" alt="image"/>-->
