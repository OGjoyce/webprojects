import java.io.BufferedOutputStream;
import java.io.BufferedReader;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.PrintWriter;
import java.net.ServerSocket;
import java.net.Socket;
import java.util.Date;
import java.util.StringTokenizer;
import java.util.logging.Logger;
import java.util.logging.Level;
import java.util.logging.Logger;
import java.util.concurrent.Executors;
import java.util.concurrent.ThreadPoolExecutor;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.OutputStream;
import java.util.Properties;


import java.io.IOException;
import org.jsoup.Jsoup;
import org.jsoup.helper.Validate;
import org.jsoup.nodes.Document;
import org.jsoup.nodes.Element;
import org.jsoup.select.Elements;

public class JavaHTTPServer {

	protected void start() {
	  ServerSocket s;
  
	  System.out.println("Webserver starting up on port 80");
	  try {
  
		s = new ServerSocket(80);
	  } catch (Exception e) {
		System.out.println("Error: " + e);
		return;
	  }
  
	  System.out.println("Waiting for connection");
	  for (;;) {
		try {
  
		  Socket remote = s.accept();
  
		  System.out.println("Connection, sending data.");
		  BufferedReader in = new BufferedReader(new InputStreamReader(
		  remote.getInputStream()));
		  PrintWriter out = new PrintWriter(remote.getOutputStream());
  
		  String str = ".";
		  System.out.println("LOGG: parsing...");
		  String html = "";
		  while (!str.equals(""))
		  {
			str = in.readLine();
			str.length();
			int index1=0;
			int index2=0;
			String str_second = "";
			if (str.indexOf("$") > 0){
				index1 = str.indexOf("$");
			System.out.println(index1);
			String new_str = str.substring(index1+1, str.length());
			System.out.println(new_str);
			str_second = new_str;
			index2 = str_second.indexOf("$");
				String new_str2 = str_second.substring(0, index2 );
				System.out.println(new_str2);	
				Document doc = Jsoup.connect(new_str2).get();	
				html = doc.outerHtml();
			}

			
			
		System.out.println(str);

		  }
		int i = 0;
		if (i==0){
		  out.println("HTTP/1.0 200 OK");
		  out.println("Content-Type: text/html");
		  out.println("Access-Control-Allow-Origin: *");
		  out.println("Server: Bot");
  
		  out.println("");
  
		  out.println(html);
		  i++;
		}
		  out.flush();
		  remote.close();
		} catch (Exception e) {
		  System.out.println("Error: " + e);
		}
	  }
	}
  
	public static void main(String args[]) {
	  JavaHTTPServer ws = new JavaHTTPServer();
	  ws.start();
	}
}