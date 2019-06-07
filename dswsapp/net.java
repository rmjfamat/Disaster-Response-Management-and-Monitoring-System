import java.net.*; 
import java.io.*; 
import java.util.*; 
import java.net.InetAddress; 
  
public class net 
{ 
    public static void main(String args[]) throws Exception 
    { 
        // Returns the instance of InetAddress containing 
        // local host name and address 
        InetAddress localhost = InetAddress.getLocalHost(); 
		String ipaddress = (localhost.getHostAddress()).trim();
		String login_url = "http://".concat(ipaddress).concat("/dswsapp/login.php");
        System.out.println("System IP Address : " + login_url); 
 

    } 
} 