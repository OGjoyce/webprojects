 
import java.io.IOException;
import java.util.logging.Level;
import java.util.logging.Logger;
 
public class HttpRequest {
 
    private static final Logger LOGGER = Logger.getLogger(HttpRequest.class.getName());
    public static void main(String[] args) throws SecurityException, IOException {
        LOGGER.info("Logger Name: "+LOGGER.getName());
        LOGGER.warning("Can cause ArrayIndexOutOfBoundsException");//poner otra cosa
        //An array of size 3
        int []a = {1,2,3};
        int index = 4;
        LOGGER.config("index is set to "+index);   
        try{
            System.out.println(a[index]);
        }catch(ArrayIndexOutOfBoundsException ex){
            LOGGER.log(Level.SEVERE, "Exception occur", ex);
        }
         
 
    }
 
}