import javax.activation.DataHandler;
import javax.activation.DataSource;
import javax.activation.FileDataSource;
import javax.mail.*;
import javax.mail.internet.MimeMessage;
import javax.mail.internet.MimeMultipart;
import javax.mail.internet.InternetAddress;
import javax.mail.internet.MimeBodyPart;
import java.io.*;
import java.util.*;


/* ############# Terminal Commands for Automation #################
 * Notes: Use ; on windows to separate jar arguments, : on linux
 * 		  -cp overrides existing classpath (preferred)
 * 
 * Compile: need to specify class path for external libraries
 * In this case, need javax.mail.jar, jaf-1_1_1.zip. Both are in folder lib. 
 * javac -cp "../lib/*" SendEmailAuto.java
 * 
 * Run: have to include current directory 
 * where class file (Email.class) is, because we are overriding class path with -cp 
 * java -cp "../lib/*;." SendEmailAuto
 * On Linux, do java -cp "../lib/*:." SendEmailAuto

 */
public class SendEmailAuto {
	/* @param multi: the Multipart that holds everything together
	 * 
	 */
	/*public static void addAttachments(Multipart multi){
		if(attachments.size() == 0)
			return;
		
		for(File f: attachments){
			try{
				BodyPart att = new MimeBodyPart();
				//need a data source for the file's path
				FileDataSource attach = new FileDataSource(f.getPath()); 
				att.setDataHandler(new DataHandler(attach));
				att.setFileName(f.getName());
				multi.addBodyPart(att);
			}
			catch(Exception e){
				System.out.println("Error attaching files.");
			}
		}
	}*/
	
	/* args[0] = from
	 * args[1] = PASSWORD
	 * args[2] = to, separated by commas with no space
	 * args[3] = cc, separated by commas with no space
	 * args[4] = subj
	 * args[5] = message type (random, casual, formal, casualNick, formalNick),(person's name) 
	 * args[6]...args[args.length] = attachments
	 */
	public static void main(String[] args) throws IOException {
		final String USERNAME = args[0];
		//System.out.println(USERNAME);
		final String PASS = args[1];
		//System.out.println(PASS);
		final String DEST = args[2];
		//System.out.println(DEST);
		final String SUBJECT = args[3];
		//System.out.println(SUBJECT);
		final String MESSAGE = args[4];
		//System.out.println(MESSAGE);
		//System.exit(0);
		if(!USERNAME.contains("@") || !DEST.contains("@")){
			System.out.println("Invalid username or destination.");
			System.exit(0);
		}
/*		Scanner scan = new Scanner(System.in);
		System.out.print("Enter password for " + USERNAME+": ");
		String password = scan.next();
		//Home directory 
		scan.close();*/
		long start = System.currentTimeMillis();

		//put in new properties, set up gmail host, port, authentication
		//basically empty hashmap
		Properties p = new Properties();
		//put it all necessary properties
		p.put("mail.smtp.auth", true);
		p.put("mail.smtp.starttls.enable", true);
		//smtp server address
		p.put("mail.smtp.host", "smtp.gmail.com"); 
		p.put("mail.smtp.port", "587");
		
		//Authenticator object for password
		Authenticator authenticator = new Authenticator(){
			protected PasswordAuthentication getPasswordAuthentication(){
				PasswordAuthentication check = new PasswordAuthentication(USERNAME, PASS);
				return check;
			}
		};	
		//create new session to send message, with authentication
		//getInstance gets a new Session object, with relevant properties and `authentication
		Session sess = Session.getInstance(p, authenticator);
		
		try{
			//message to send. (add everything to this with setContent(Multipart)
			MimeMessage m = new MimeMessage(sess);
			
			//Check for authentication, else throw AuthenticationException
			Transport trans = sess.getTransport("smtp");
			trans.connect("smtp.gmail.com", USERNAME,  PASS);
			
			//If authentication succeeds, start attaching files to email
			//File home = new File(System.getProperty("user.home"));
			//gets filename from path
			//convertToFiles(home, args);
			
			//For multiple senders? Idk how this is even possible
			InternetAddress from = new InternetAddress(USERNAME);
			from.setPersonal("Duke Exchange");
			m.setFrom(from);
			m.setSubject(SUBJECT);
			
			//Array of people I want to CC
/*			if(!CC.equals("")){
				InternetAddress[] cc = InternetAddress.parse(CC);
				m.addRecipients(Message.RecipientType.CC, cc);
			}*/
			//Array of people I want to send email to
			InternetAddress[] to = InternetAddress.parse(DEST);
			m.setRecipients(Message.RecipientType.TO, to);

			//for text use multipart to hold everything together
			MimeMultipart multi = new MimeMultipart();
			//Add the message
			MimeBodyPart text= new MimeBodyPart();
			//use hashset for this later
			text.setContent(MESSAGE, "text/html");
			multi.addBodyPart(text);
			//for attachment, create a new body parts to attach attachments
			//addAttachments(multi);
			
			//Sets content of message to include all parts of the multipart
			m.setContent(multi);
			//Actually sends message- send is static method, so use class to access
			
			Transport.send(m);
			//System.out.println("Message successfully sent.");
		}
		catch(MessagingException e){
			System.out.println("Email failed to send. Check username and password.");
		}
	}
}