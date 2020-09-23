var chat_data = {}, user_uuid, chatHTML = '', chat_uuid = "", userList = [];
		firebase.auth().onAuthStateChanged(function(user) {
		  if (user) {
		    console.log(user);
		    user_uuid = user.uid;

			getUsers();
		    console.log(user_uuid);

		  } else {
		    console.log("Not sign in");
		  }
		});


		function logout(){
			
			$.ajax({
				url : '',
				method : 'POST',
				data : {logoutUser:1},
				success : function(response){
					console.log(response);
					firebase.auth().signOut().then(function() {
					  console.log('Logout');

					  window.location.href = "index.php";

					}).catch(function(error) {
					  // An error happened.
					  console.log('Logout Fail');
					});
				}
			});
			
		}
		

		
		function getUsers(){
			
			$.ajaxSetup({
			    headers: {
			      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});

            $.ajax({
                url : "http://localhost/mariners_chat79/chat/getUsers",
                method : 'POST',
                data : {getUsers:1},
                success : function(response){

                	console.log('response 1'+response);

                	// var response = '{"status":200,"message":{"users":[{"uuid":"d7123121-f29a-11ea-9087-38b1db6724fd","fullname":"Akhil Trivedi","username":"akhil"},{"uuid":"e9fa79c8-f29a-11ea-9087-38b1db6724fd","fullname":"kavan trivedi","username":"kavan"},{"uuid":"f5c5e812-f29a-11ea-9087-38b1db6724fd","fullname":"dhaval","username":"dhaval"}]}}';

                    // console.log('response 2'+response);
					var resp = JSON.parse(JSON.stringify(response));
                    if(resp.status == 200){
                        var users = resp.message.users;
                        var usersHTML = '';
                        var messageCount = '';
                        $.each(users, function(index, value){
                            console.log(value.uuid)
                            if (user_uuid != value.uuid) {
                                
                                usersHTML +='<div class="user" uuid="'+value.uuid+'">'+
                                            '<div class="user-image"></div>'+
                                            '<div class="user-details">'+
                                                '<span><strong>'+ value.fullname+'<span  class="count"></span></strong></span>'+
                                                '<span>Last Login</span>'+
                                            '</div>'+
                                        '</div>';

                                userList.push({user_uuid: value.uuid, username: value.username});
                            }                            
                        });
                        $(".users").html(usersHTML);

                    }else{
                        console.log(response.message);
                    }
                }
            });
        }
		

		$(document.body).on('click', '.user', function(){
			console.log($(this).attr('uuid'));
			
			var name = $(this).find("strong").text();
			var user_1 = user_uuid;
			var user_2 = $(this).attr('uuid');
			$('.message-container').html('Connecting...!');

			$(".name").text(name);
			$.ajaxSetup({
			    headers: {
			      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});

			$.ajax({
				url : 'http://localhost/mariners_chat79/chat/createChatRecord',
				method : 'POST',
				data : {connectUser:1, user_1:user_1, user_2: user_2},
				success : function(resposne){
					console.log('create chat responce : '+resposne);
					var resp = JSON.parse(resposne);
					chat_data = {
						chat_uuid : resp.message.chat_uuid,
						user_1_uuid : resp.message.user_1_uuid,
						user_2_uuid : resp.message.user_2_uuid,
						user_1_name : '',
						user_2_name : name
					};
					console.log('chat data: '.chat_data)
					$('.message-container').html('Say Hi to '+name);

					db.collection('chat').where('chat_uuid', '==', chat_data.chat_uuid)
					.orderBy("time")
					.get().then(function(querySnapshot){
						chatHTML = '';
						querySnapshot.forEach(function(doc){
							console.log(doc.data());
							if (doc.data().user_1_uuid == user_uuid) {

								chatHTML += '<div class="message-block">'+
												'<div class="user-icon"></div>'+
												'<div class="message">'+ doc.data().message +'</div>'+
											'</div>';

							}else{
								chatHTML += '<div class="message-block received-message">'+
												'<div class="user-icon"></div>'+
												'<div class="message">'+ doc.data().message +'</div>'+
											'</div>';
							}

						});

						$(".message-container").html(chatHTML);

					});

					if (chat_uuid == "") {
						chat_uuid = chat_data.chat_uuid;
						realTime();
					}

				}
			});


		})

		$(".send-btn").on('click', function(){
			var message = $(".message-input").val();
			if(message != ""){
				db.collection("chat").add({
				    message : message,
				    user_1_uuid : user_uuid,
				    user_2_uuid : chat_data.user_2_uuid,
				    chat_uuid : chat_data.chat_uuid,
				   	user_1_isView : 0,
				   	user_2_isView : 0,
				    time : new Date(),
				})
				.then(function(docRef) {
					$(".message-input").val("");
				    console.log("Document written with ID: ", docRef.id);
				})
				.catch(function(error) {
				    console.error("Error adding document: ", error);
				});
			}


		});
		var newMessage = '';
		function realTime(){
			db.collection('chat').where('chat_uuid', '==', chat_data.chat_uuid)
			.orderBy('time')
			.onSnapshot(function(snapshot) {
				newMessage = '';
		        snapshot.docChanges().forEach(function(change) {
		            if (change.type === "added") {
		                
		                console.log(change.doc.data());
		                
		                if (change.doc.data().user_1_uuid == user_uuid) {

								newMessage += '<div class="message-block">'+
												'<div class="user-icon"></div>'+
												'<div class="message">'+ change.doc.data().message +'</div>'+
											'</div>';

							}else{
								newMessage += '<div class="message-block received-message">'+
												'<div class="user-icon"></div>'+
												'<div class="message">'+ change.doc.data().message +'</div>'+
											'</div>';
							}



		            }
		            if (change.type === "modified") {
		               
		            }
		            if (change.type === "removed") {
		                
		            }
		        });

		        if (chatHTML != newMessage) {
		        	$('.message-container').append(newMessage);
		        }
		        
		        $(".chats").scrollTop($(".chats")[0].scrollHeight);

		    });
			

			

		}