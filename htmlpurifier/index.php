<?php

// Inialize session
session_start();

/*
if (eregi("MSIE",getenv("HTTP_USER_AGENT")) ||
   eregi("Internet Explorer",getenv("HTTP_USER_AGENT"))) {
	Header("Location: error.html");
	exit;
}
else{*/
	// Check, if user is already login, then jump to secured page
	if (isset($_SESSION['studNum'])) {
		header('Location: mobile.php');
	}
	if (isset($_SESSION['teacherId'])) {
		header('Location: teach.php');
	}
///}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head> 
		<meta name='viewport' content="user-scalable=no,width=device-width" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>M-Learning</title> 
		<link rel="stylesheet" href="css/theme/jqmcustom.min.css" />
		<link rel="stylesheet" href="jqm1.3/jquery.mobile.structure-1.3.0-rc.1.min.css" />
		<!--link rel="stylesheet" href="jqm1.3/jqm.css" /-->
		<link rel="stylesheet" href="css/style.css" />
		<script type="text/javascript" src="jquery/jquery-1.8.2.min.js"></script>
		<script type="text/javascript" src="jqm1.3/jqm.js"></script>
		<script type="text/javascript" src="fastclick.js"></script>
		<script type="text/javascript" src="validate.js"></script>
	</head> 

	<body> 
		<div data-role='page' id='index' data-theme='a'>
			<div data-role="popup" id="popupMenu"  data-theme="a">
				<ul data-role="listview" data-inset="true" style="min-width:210px;" data-theme="c">
					<li><a href='#index' class="ui-btn-active ui-state-persist">Log in</a></li>
					<li><a href='#createnew' >Create New Account</a></li>
					<li><a href='#studentuse' class='manualbutton' >Manual</a></li>
					<li><a href='#testers' class='manualbutton' >Testing and Evaluation</a></li>
				</ul>
			</div>
			<div data-role="popup" id="loginerrorpop" class="ui-content" data-theme='a' style="max-width:280px">
				<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
				<div data-role='content' id="loginNote"></div>
			</div>
			<div data-role="popup" id="forgotPasswordPop" data-theme="a">
				<div data-role="popup" id="forgotPasswordForm" data-theme="a" class="ui-corner-all">
						<div style="padding:10px 20px;">
						  <h3>Forgot Password</h3>
							<label for="newmaterialtitle" class="ui-hidden-accessible">username</label>
							<input type="text" name="username" id="forgotpassusername" value="" placeholder="username" data-theme="a">	
							<div id='captchacontainer'>
								<img src="plugins/captcha/captcha_code_file.php?rand=<?php echo rand();?>" id='captchaimg' ><br/>
								<label for='message'>Enter the code above here: </label>
								<br>
								<input id="captchacode" name="6_letters_code" type="text">
								<br>
								Can't read the image? click <a href='#' id='refreshcaptchalink'>here</a> to refresh
								</p>
							</div>
							<div class='center-wrapper'>
								<button id='submitforgotpass' class="center-button" data-mini='true' data-theme="b" data-inline='true'>Submit</button>
								<button id='cancelforgotpass' class="center-button" data-mini='true' data-theme="b" data-inline='true'>Cancel</button>
							</div>
						</div>
				</div>
			</div>
			<div data-role='header'> 
				<a id='popupMenuButton' class='buttonmenu' href="#popupMenu" data-rel="popup" data-role="button" data-inline="true" data-theme="a">Menu</a>
				<h3>Welcome</h3> 
			</div>
			
			<div data-role='content' id="logincontent">
				<div class='sidebar'>
					<ul  data-role='listview' data-inset='true'>
						<li><a href='#index' class="ui-btn-active ui-state-persist">Log in</a></li>
						<li><a href='#createnew' >Create New Account</a></li>
						<li><a href='#studentuse' class='manualbutton' >Manual</a></li>
						<li><a href='#testers' class='manualbutton' >Testing and Evaluation</a></li>
					</ul>
				</div>
				<div class='maincontent'>
					<br/>
					<form id="loginForm">
						<label><b>Username:</b></label>
						<input data-mini='true' class='textfield' type="text" name="username" id="username" /><br/>
						<label><b>Password:</b></label>
						<input data-mini='true' class='textfield' type="password" name="pass" id="pass" /><br/>
						<input type="button" value="Login" name="login_button" id="login_button" data-inline='true' />
						<a href='#forgotPasswordForm' data-role='button' data-rel="popup" data-inline='true'>Forgot Password</a>
					</form>
					<p id='statustext'></p>
					<div>
					<span class='fielderror'>Warning: You may get disconnected sometimes because this app is only hosted in a free webhost(sorry bout that).<br/><br/></span>
					<span class='italicized'>
					If you have smartphones or tablets, please use them also as this app is intended for mobile device use. <b>And please don't forget to answer the </b>
					<a href='https://docs.google.com/forms/d/1C21lKimQhKIboAq24mZ0VPNEAX7_ccZStKFk3mGbNic/viewform' data-icon="arrow-d" data-role='button' data-mini='true' data-inline='true' target="_blank">evaluation form</a><br/>
					<br/><strong>Teacher demo</strong>
					<br/>Username: demoteacher | Password: 1234567
					<br/>OR
					<br/>Username: larrypage | Password: qwertyu
					<br/>
					<br/><strong>Student demo</strong>
					<br/>Username: demostudent | Password: 1234567
					</span>
					<br/><br/>
					Feel free to explore and click at anything in the navigation bar. Don't worry, it won't break :) 
					<br/><br/>
					If the device you are using has a small screen or is in portrait mode, use the button
					<a href='#samplePop' data-rel="popup" data-role='button' data-mini='true' data-inline='true'>Menu</a> in the top left corner for navigation.
					</div>
				</div>
			</div>
		</div>
		
		
		<div data-role='page' id='createnew' data-theme='a'>
			<div data-role="popup"  id="popupMenu" data-theme="c">
				<ul data-role="listview" data-inset="true" style="min-width:210px;" data-theme="a">
					<li><a href='#index'>Log in</a></li>
					<li><a href='#createnew'  class="ui-btn-active ui-state-persist">Create New Account</a></li>
					<li><a href='#studentuse' class='manualbutton' >Manual</a></li>
					<li><a href='#testers' class='manualbutton' >Testing and Evaluation</a></li>
				</ul>
			</div>
			<div data-role="popup" id="submiterrorpop" class="ui-content" data-theme='a' style="max-width:280px">
				<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
				<div data-role='content' id='submitNotification'>
					<p>Please fill out the forms properly.</p>
				</div>
			</div>
			<div data-role='header'>
				<a id='popupMenuButton' class='buttonmenu' href="#popupMenu" data-rel="popup" data-role="button" data-inline="true" data-theme="a">Menu</a>
				<h3>Create New User Account</h3> 
			</div>
			<div data-role='content' id="createcontent">
				<div class='sidebar'>
					<ul data-role='listview' data-inset='true'>
						<li><a href='#index'>Log in</a></li>
						<li><a href='#createnew' class="ui-btn-active  ui-state-persist">Create New Account</a></li>
						<li><a href='#studentuse' class='manualbutton' >Manual</a></li>
						<li><a href='#testers' class='manualbutton' >Testing and Evaluation</a></li>
					</ul>
				</div>
				<div class='maincontent'>
					<br/><br/>
					<form id="userDataForm" >
						<label>Student Number: (yyyy-xxxx)</label><div id="stnumnote"></div>
						<input data-mini='true'  type="text" name="studNum" id="studNum"  maxlength="10" />
						<label>First Name:</label> <div id="fnamenote"></div>
						<input data-mini='true'  type="text" name="fname" id="fname"/>
						<label>Last Name:</label> <div id="lnamenote"></div>
						<input data-mini='true'  type="text" name="lname" id="lname" />
						<label>Email Address:</label> <div id="eaddnote"></div>
						<input data-mini='true'  type="text" name="eadd" id="eadd" />
						<label>Username:</label> (5-20 characters, alphanumeric only) <div id="usernamenote"></div>
						<input data-mini='true'  type="text" name="createusername" id="createusername" maxlength="20" />
						<label>Password:</label> (7 characters minimum, alphanumeric only) <div id="passnote"></div>
						<input data-mini='true'  type="password" name="createpass" id="createpass" maxlength="30" />
						<label>Verify Password:</label> <div id="passvnote"></div>
						<input data-mini='true'  type="password" name="verifypass" id="verifypass" />
						<i>All forms must be filled.</i>
						<div class='ui-grid-a'>
							<div class='ui-block-a'>
								<input data-inline='true' type="button" value="Submit" id="submitbutton" />
								<a href='' data-role='button' data-inline='true' onclick="document.getElementById('userDataForm').reset()">Reset</a>
							</div>
							<div class='ui-block-b'>
								<!--input type="button" value="Reset" onclick="resetFields()"/-->
								
							</div>
						</div>
					</form>
				</div>
			</div>	
		</div>
		
		<div data-role="page" data-theme="a" id='studentuse'>
			<div data-role="popup" id="popupMenu"  data-theme="d">
				<ul data-role="listview" data-inset="true" style="min-width:210px;" data-theme="a">
					<li><a href='#index' class='indexbutton'>Log in</a></li>
					<li><a href='#studentuse' class="ui-btn-active  ui-state-persist" >Student Manual</a></li>
					<li><a href='#teacheruse'>Teacher Manual</a></li>
					<li><a href='#testers' class='manualbutton' >Testing and Evaluation</a></li>
				</ul>
			</div>
			<div data-role="popup" id="samplePop"  data-theme="a">
				<ul data-role="listview" data-inset="true" style="min-width:210px;" data-theme="c">
					<li><a href='index.php' class='indexbutton'>Log in</a></li>
					<li><a href='#' >Create New Account</a></li>
					<li><a href='#' >Student Manual</a></li>	
				</ul>
			</div>
			<div data-role="header" data-position="fixed"> 
				<h3 >Student Manual</h3> 
				<a id='popupMenuButton' class='buttonmenu' href="#popupMenu" data-rel="popup" data-role="button" data-inline="true"  data-theme="a">Menu</a>
			</div>
			<div data-role="content">
				<div class="sidebar"> 
					<ul data-role='listview' data-inset='true' data-theme='a'>
						<li><a href='#index' class='indexbutton'>Log in</a></li>
						<li><a href='#studentuse' class="ui-btn-active  ui-state-persist" >Student Manual</a></li>
						<li><a href='#teacheruse'>Teacher Manual</a></li>
						<li><a href='#testers' class='manualbutton' >Testing and Evaluation</a></li>
					</ul>
				</div><!----- secondary content ------->
				<div class="maincontent"> 
					<h2>Student Manual</h2>
					<hr/>
					<h4>Navigation</h4>
					<p>The navigation for this web app depends on your device's screen width and orientation. If your screen width is atleast 768 pixels 
					and is in landscape orientation, the sidebar
					<div class='samplesidebar'>
					<ul data-role='listview' data-inset='true' data-theme='a'>
						<li><a href='#'>Log in</a></li>
						<li><a href='#'>Create New Account</a></li>
						<li><a href='#'>Student Manual</a></li>
					</ul>
					</div>
					will be available for use. Otherwise, the button
					<a href='#samplePop' data-rel="popup" data-role='button' data-mini='true' data-inline='true'>Menu</a>
					,will become available at the upper left corner of the page, inside the header. This button will show the navigation panel. <br/><br/>
					<span class='fielderror'>Important: Avoid refreshing your browser when visiting other pages. 
					Refreshing will cause the browser to redirect to the homepage. Just be a little more patient because this app is only hosted 
					on a free webhost which are sometimes slow.</span></p>
					<hr/>
					
					<h4>Home page</h4>
					<p>In the homepage, you will see the latest announcements from your enrolled courses. Only the latest 15 announcements will be available.</p>
					<hr/>
					
					<h4>Course Management</h4>
					<p>In the course page, you will see all your enrolled courses listed. Clicking on a course in the list will redirect you to the home page of that specific
					course.<br/><br/> If you want to add a course press the button 
					<a href='#' data-role='button' data-mini='true' data-icon='plus' data-inline='true'>Add Courses</a> and you will be 
					directed to the page where all the available 
					courses are listed.<br/><br/>
					To enroll to a course, just click the course and a popup will appear displaying the details of the course and a input field where 
					you will put the enrollment key provided by your instructor.</p>
					<hr/>
					
					<h4>Messaging</h4>
					<p>One of the interaction tools provided by this app is a <b>basic messaging system</b>. In the messages page, you can choose whether to 
					compose a new message, go to your inbox or go to your outbox. The number besides the inbox button is the number of your unread messages.
					While the number in the outbox button is the number of your outbox messages. <br/><br/>When you go to the inbox or outbox, your messages
					will be listed by date along with buttons for deletion. Clicking on a message in the list will show you the content of the message along with a reply
					button.<br/><br/>
					When composing a new message, all fields must be filled properly and only a single username can be put in the recipient field (hence the word basic).
					</p><hr/>
					
					<h4>Account Settings</h4>
					<p>In the account settings page, you can set a new password or email, provided that the input values are valid.				
					</p><hr/>
					
					<h4>Course Home</h4>
					<p>Once you click a course in the list in the course page, you will be redirected here. In the course home, you will see all the announcements posted by your instructors
					in that certain course. <br/><br/>
					Also, from here on, the buttons on the navigation panel will be changed to course-related pages.						
					</p><hr/>
					
					<h4>Chapters and Topics</h4>
					<p>The chapters page contains the main educational contents of the course. The contents are arranged by chapter number. If you click in a chapter in the list, you will be presented
					with all the topics and their content under that specific chapter. <br/><br/> The topics contain a topic title, text content and maybe some material links (pdf, audio, video, reviewers).
					Clicking a material link will redirect you to a page where it will embedded for your viewing or listening. A link to the discussion thread specific to that topic will also be
					available.
					</p><hr/>
					
					<h4>Discussions</h4>
					<p> The discussions page contains all the discussion threads of each and every topic of the course. There will be a little number in the right side that indicates
					the total posts for that thread. Clicking on a discussion thread in the list will show you all of the posts along with a reply button. You can also create a new post
					by clicking the <a href='#' data-role='button' data-mini='true' data-icon='plus' data-inline='true'>post message</a> button and a text area will appear. Cancelling will hide the text input area.
					You can also edit your own posts by clicking the <a href='#' data-role='button' data-mini='true' data-icon='gear' data-inline='true' data-iconpos='notext'></a> on top of it.
					</p><hr/>
					
					<h4>Materials</h4>
					<p>	The materials page will contain all the material links available to the course. There are only three types of material links and these are <b>pdf, audio and video</b>.
					Clicking on the button of the material type will show you a list of all the material links, some of which maybe referenced by topics. Clicking on a material link in the list
					will redirect you to the page where it will be embedded and an option will be given to view the material from the original source in the form of a button. 
					</p><hr/>
					
					<h4>Reviewers(Quizzes)</h4>
					<p>	The reviewers page contains a list of all the reviewers available to the course and your scores in each of them(if answered already). All of the reviewers are in the form of multiple choices.
					Clicking the <a href='#' data-role='button' data-mini='true' data-icon='edit' data-inline='true'>answer</a> button 
					will enable you to answer the reviewer and submit the answers for evaluation. After submitting, your grade will be recorded and the right answers will be shown.
					You can answer a reviewer multiple times but only the score on your first attempt will be recorded.
					</p><hr/>					
					
					<h4>Notes</h4>
					<p>	The notes page contains all the personal notes you created for the course. You can create a new note or view,edit or delete the existing notes. The rich text editor
					will only be available to PC users while for mobile device users(smartphones, tablets), a normal text area will be provided.
					</p><hr/>		
					
				</div>
			</div>
		</div>
		
		<div data-role="page" data-theme="a" id='teacheruse'>
			<div data-role="popup" id="popupMenu"  data-theme="d">
				<ul data-role="listview" data-inset="true" style="min-width:210px;" data-theme="a">
					<li><a href='#index' class='indexbutton'>Log in</a></li>
					<li><a href='#studentuse' >Student Manual</a></li>
					<li><a href='#teacheruse' class="ui-btn-active  ui-state-persist" >Teacher Manual</a></li>
					<li><a href='#testers' class='manualbutton' >Testing and Evaluation</a></li>
				</ul>
			</div>
			<div data-role="popup" id="samplePop"  data-theme="a">
				<ul data-role="listview" data-inset="true" style="min-width:210px;" data-theme="c">
					<li><a href='#'>Log in</a></li>
					<li><a href='#' >Create New Account</a></li>
					<li><a href='#' >Student Manual</a></li>
				</ul>
			</div>
			<div data-role="header" data-position="fixed"> 
				<h3 >Teacher Manual</h3> 
				<a id='popupMenuButton' class='buttonmenu' href="#popupMenu" data-rel="popup" data-role="button" data-inline="true"  data-theme="a">Menu</a>
			</div>
			<div data-role="content">
				<div class="sidebar"> 
					<ul data-role='listview' data-inset='true' data-theme='a'>
						<li><a href='#index' class='indexbutton'>Log in</a></li>
						<li><a href='#studentuse'>Student Manual</a></li>
						<li><a href='#teacheruse' class="ui-btn-active  ui-state-persist" >Teacher Manual</a></li>
						<li><a href='#testers' class='manualbutton' >Testing and Evaluation</a></li>
					</ul>
				</div><!----- secondary content ------->
				<div class="maincontent"> 
					<h2>Teacher Manual</h2>
					<hr/>
					<h4>Navigation</h4>
					<p>The navigation for this web app depends on your device's screen width and orientation. If your screen width is atleast 768 pixels 
					and is in landscape orientation, the sidebar
					<div class='samplesidebar'>
					<ul data-role='listview' data-inset='true' data-theme='a'>
						<li><a href='#'>Log in</a></li>
						<li><a href='#'>Create New Account</a></li>
						<li><a href='#'>Student Manual</a></li>
					</ul>
					</div>
					will be available for use. Otherwise, the button
					<a href='#samplePop' data-rel="popup" data-role='button' data-mini='true' data-inline='true'>Menu</a>
					,will become available at the upper left corner of the page, inside the header. This button will show the navigation panel. <br/><br/>
					<span class='fielderror'>Important: Avoid refreshing your browser when visiting other pages. 
					Refreshing will cause the browser to redirect to the homepage. Just be a little more patient because this app is only hosted 
					on a free webhost which are sometimes slow.</span></p>
					<hr/>
					
					<h4>Course Management</h4>
					<p>In the home page, you will see all your handled courses listed. Clicking on a course in the list will redirect you to the home page of that specific
					course.</p>
					<hr/>
					
					<h4>Messaging</h4>
					<p>One of the interaction tools provided by this app is a <b>basic messaging system</b>. In the messages page, you can choose whether to 
					compose a new message, go to your inbox or go to your outbox. The number besides the inbox button is the number of your unread messages.
					While the number in the outbox button is the number of your outbox messages. <br/><br/>When you go to the inbox or outbox, your messages
					will be listed by date along with buttons for deletion. Clicking on a message in the list will show you the content of the message along with a reply
					button.<br/><br/>
					When composing a new message, all fields must be filled properly and only a single username can be put in the recipient field (hence the word basic).
					</p><hr/>
					
					<h4>Account Settings</h4>
					<p>In the account settings page, you can set a new password or email, provided that the input values are valid.				
					</p><hr/>
					
					<h4>Course Home</h4>
					<p>Once you click a course in the list in the course page, you will be redirected here. In the course home, you will see all the announcements posted
					in that certain course. You can add a new announcement by clicking the 
					<a href='#' data-role='button' data-mini='true' data-icon='plus' data-inline='true'>add announcement</a> button. This will reveal text fields for creating a new announcement.					
					Pressing cancel will hide the text fields.
					<br/><br/>
					Also, from here on, the buttons on the navigation panel will be changed to course-related pages.					
					</p><hr/>
					
					<h4>Chapters and Topics</h4>
					<p>The chapters page contains the main educational contents of the course. The contents are arranged by chapter number. If you click in a chapter in the list, you will be presented
					with all the topics and their content under that specific chapter. If you want to add another chapter, press the <a href='#' data-role='button' data-mini='true' data-icon='plus' data-inline='true' data-iconpos='notext'></a>
					button in the upper-right corner.<br/><br/> The topics contain a topic title, text content and maybe some material links (pdf, audio, video, reviewers).
					Clicking a material link will redirect you to a page where it will embedded for your viewing or listening. A link to the discussion thread specific to that topic will also be
					available.
					<br/><br/>
					To create a new topic for a chapter, click the chapter in the list where you wish to add a topic. 
					Then press the <a href='#' data-role='button' data-mini='true' data-icon='plus' data-inline='true' data-iconpos='notext'></a> button in the upper-right most corner inside the header(color maroon bar). 
					You will be redirected to the create topic page where you must fill the forms properly. There, you may add new materials links or add existing material links.
					You can also add a link for a published reviewer(see reviewer section for published reviewers). A discussion thread will be created automatically for that
					topic and a link for that discussion thread will also be automatically attached.
					<br/><br/>
					The next button  
					<a href='#' data-role='button' data-mini='true' data-icon='gear' data-inline='true' data-iconpos='notext'></a> which is also inside the header is the edit 
					chapter title button. Pressing it will show a popup where you can change the title of the current chapter you are viewing.
					<br/><br/>
					The topics shown will each have a <a href='#' data-role='button' data-mini='true' data-icon='gear' data-inline='true' data-iconpos='notext'></a> and a 
					<a href='#' data-role='button' data-mini='true' data-icon='delete' data-inline='true' data-iconpos='notext'></a> buttons in their upper right corner. The first button(gear),
					is for editing the topic. Pressing it will redirect you to the create topic page again but this time, the contents of the topic will be already pre-loaded in the forms.
					Just change the things you want to edit and press submit again to save the changes. While the second button(delete) is for deleting the topic.
					</p><hr/>
					
					<h4>Discussions</h4>
					<p> The discussions page contains all the discussion threads of each and every topic of the course. There will be a little number in the right side that indicates
					the total posts for that thread. Clicking on a discussion thread in the list will show you all of the posts along with a reply button. You can also create a new post
					by clicking the <a href='#' data-role='button' data-mini='true' data-icon='plus' data-inline='true'>post message</a> button and a text area will appear. Cancelling will hide the text input area.
					As a teacher, you will be given the privilege to edit the posts of your students aside from your own posts, to ensure that the thread will be regulated. Pressing the
					<a href='#' data-role='button' data-mini='true' data-icon='gear' data-inline='true' data-iconpos='notext'></a> button will edit the message.
					</p><hr/>
					
					<h4>Materials</h4>
					<p>	The materials page will contain all the material links available to the course. There are only three types of material links and these are <b>pdf, audio and video</b>.
					Clicking on the button of the material type will show you a list of all the material links, some of which maybe referenced by topics. Clicking on a material link in the list
					will redirect you to the page where it will be embedded and an option will be given to view the material from the original source in the form of a button. 
					<br/><br/>
					You can also edit and delete materials. Clicking the edit button will show a popup form where you can edit the details of the material link. While presing delete will prompt you whether
					if you want to proceed with the deletion of the material link. Deleting a material link will also remove all the links from the topics where it is referenced.
					</p><hr/>
					
					<h4>Reviewers(Quizzes)</h4>
					<p>	The reviewers page contains a list of all the reviewers available to the course. You can create a new reviewer by clicking the create new reviewer button and this will
					redirect you to the create reviewer page. 
					<br/><br/>
					For creating a reviewer, first fill the input field for the title properly. Then you can add new items for the reviewer. Create a question then fill in the choices and the selector to the
					the right choice. You have the option to create up to six choices per question. You can also just leave the unused choices blank should you wish to use less than six. Pressing the
					save reviewer button will save it to the database.
					<br/><br/>
					Once you created a reviewer, you have the option to view,edit, publish or delete the reviewer. Editing it will redirect you again to the page where you created the reviewer although the input fields
					are now filled with the current values of the reviewer. You can edit a reviewer as many times as you can as long as it is still not published.
					<br/><br/>
					If you are satisfied with the reviewer, you can publish it by pressing the publish button. Only published reviewers are visible to students. The reviewer will also now become 
					uneditable although it is still deletable. After publishing, you can now view the grades of your students for that reviewer. Only the scores fromt the first attempts of the students
					will be recorded together with date of answering.
					<br/><br/>
					The view function of the reviewer will display all the questions and their respective answers. If the reviewer is published, it will show the breakdown on the percentage of what choice your students chose
					so you can further assess their general performance and focus on the areas that need improvement.
					
					</p><hr/>					
					
				</div>
			</div>
		</div>
		
		<div data-role="page" data-theme="a" id="testers">
			<div data-role="popup" id="popupMenu"  data-theme="d">
				<ul data-role="listview" data-inset="true" style="min-width:210px;" data-theme="a">
					<li><a href='#index'>Log in</a></li>
					<li><a href='#createnew' >Create New Account</a></li>
					<li><a href='#studentuse' class='manualbutton' >Manual</a></li>
					<li><a href='#testers' class='manualbutton' class="ui-btn-active ui-state-persist">Testing and Evaluation</a></li>
				</ul>
			</div>
			<div data-role="header" data-position="fixed"> 
				<h3>Testing and Evaluation</h3>
				<a id='popupMenuButton' class='buttonmenu' href="#popupMenu" data-rel="popup" data-role="button" data-inline="true"  data-theme="a">Menu</a>
			</div>
			<div data-role="content">
				<div class="sidebar">
					<ul data-role='listview' data-inset='true' data-theme='a'>
						<li><a href='#index'>Log in</a></li>
						<li><a href='#createnew' >Create New Account</a></li>
						<li><a href='#studentuse' class='manualbutton' >Manual</a></li>
						<li><a href='#testers' class='manualbutton' class="ui-btn-active ui-state-persist">Testing and Evaluation</a></li>
					</ul>		
				</div>
				<div class="maincontent"> 
					<h3>Accounts</h3>
					For student users, you may create/register a new account. You may use fake info in the registration inputs. Or you may simply use the demo account provided in the login page.
					<br/><br/>
					For teachers, you can use the demo account provided or you may email me at system.smolsp@gmail.com for a request of a new teacher account. If you wish to request for a new teacher account,
					please provide the following information on the email:<br/>
					<ul>
						<li>Username</li>
						<li>Password</li>
						<li>Name(if you have a title like Prof., include as well)</li>
						<li>Course code (e.g. MATH 101, ENG 10)</li>
						<li>Course title</li>
						<li>Course description</li>
						<li>Course section</li>
						<li>Enrollment key</li>
					</ul>
					A teacher account can handle multiple courses, just provide the necessary course info.<br/><br/>
					<span class='fielderror'>Warning: if you opt to use the demo accounts, don't be surprised if the content you created suddenly disappears or changes. There might be other testers
					who are logged in the demo accounts.</span>
					<h3>Evaluation</h3>
					<a href='https://docs.google.com/forms/d/1C21lKimQhKIboAq24mZ0VPNEAX7_ccZStKFk3mGbNic/viewform' data-icon="arrow-d" data-role='button' data-inline='true' target="_blank">Online evaluation form</a>
					<a href='https://dl.dropbox.com/u/20621079/evaluation_form.doc' data-icon="arrow-d" data-role='button' data-inline='true' target="_blank">evaluation form (word doc)</a>
					<br/>Please answer the online evaluation form by click on the button 'online evaluation form' above. OR you can download the evaluation form in a word document file. If you opt for the word doc, 
					please email the answered document to system.smolsp@gmail.com or marlo.liwanag@gmail.com.
					<br/><br/>
					Thank you very much for your participation. :)
				</div>
			</div>
		</div>
		<!-- END PAGE-->
	</body> 
</html> 