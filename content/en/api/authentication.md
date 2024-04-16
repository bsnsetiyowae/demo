---
title: Authentication & Security
---

## Authentication

You'll need to authenticate your requests to access any of the endpoints in the {brand} API. {brand} offers authentication using two types of tokens: `api_key` and `secret_key`. These tokens are used to encrypt the parameters in each request.

The encrypted parameters are decrypted and validated by our system using the same token in our records. Once the validation is successful, the request is processed, and a response is returned.

---

## Security

We have our own algorithm for making requests to hit our endpoint. This algorithm referred to the [security pre-requirements](/docs/pre-requirements) which requires to generate key for each transaction.

## Template Code
we provide some code snippets to help in development.

### PHP
```php title="encrypt_decrypt.php"
public function encrypt_decrypt($action, $string, $apikey = '{your_api_key}', $secretkey = '{your_secret_key}') {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = $apikey;
    $secret_iv = $secretkey;
        // hash
    $key = substr(hash('sha256', $secret_key, true), 0, 32);

    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, OPENSSL_RAW_DATA, $iv);
        $output = base64_encode($output);
        $output = urlencode($output);
    } else if( $action == 'decrypt' ) {
     $output = openssl_decrypt(base64_decode(urldecode($string)), $encrypt_method, $key, OPENSSL_RAW_DATA, $iv);
 }
 return $output;
}
```

### C#
```csharp title="encrypt_decrypt.cs"
using System;
using System.Security.Cryptography;
using System.Text;
using System.IO;
public class EncryptDecrypt
{
  public static void Main()
  {
      string source = "currency_code=INR&merchant_code=213213&merchant_api_key=3213212ewfewqfwqf&transaction_code=TEST-DP-163158903432&transaction_timestamp=1631589012&bank_code=1003&transaction_amount=1000";
      string apiKey =  "3213212ewfewqfwqf";
      string secretKey =  "jdo383f1d2021ehd1dj2di32";
      string result = encrypt_decrypt("encrypt", source, apiKey, secretKey);
      Console.WriteLine("The key of  " + source + " is: " + result);
      Console.WriteLine("Decoded of key " + result + " is: " +  encrypt_decrypt("decrypt", result, apiKey, secretKey));
  }

  public static string encrypt_decrypt(string action, string payload, string apikey, string secretkey){
  string secret_iv = secretkey;

  string iv = hashSha256(secret_iv).Substring(0, 16);

  SHA256 mySHA256 = SHA256Managed.Create();

  string output = "";
  if ( action == "encrypt" ) {
      output = EncryptString(payload, mySHA256.ComputeHash(Encoding.ASCII.GetBytes(apikey)), Encoding.ASCII.GetBytes(iv));
      } else if( action == "decrypt" ) {
          output = DecryptString(payload, mySHA256.ComputeHash(Encoding.ASCII.GetBytes(apikey)), Encoding.ASCII.GetBytes(iv));
      }
      return output;
  }


  public static string hashSha256(string payload){
      string hash = "";
      using (SHA256 sha256Hash = SHA256.Create()){
          byte[] sourceBytes = Encoding.UTF8.GetBytes(payload);
          byte[] hashBytes = sha256Hash.ComputeHash(sourceBytes);
          hash = BitConverter.ToString(hashBytes).Replace("-", String.Empty).ToLower();
      }
      return hash;
  }

  public static string EncryptString(string plainText, byte[] key, byte[] iv)
  {
      Aes encryptor = Aes.Create();
      encryptor.Mode = CipherMode.CBC;
      encryptor.Key = key;
      encryptor.IV = iv;
      MemoryStream memoryStream = new MemoryStream();
      ICryptoTransform aesEncryptor = encryptor.CreateEncryptor();
      CryptoStream cryptoStream = new CryptoStream(memoryStream, aesEncryptor, CryptoStreamMode . Write);
      byte[] plainBytes = Encoding.ASCII.GetBytes(plainText);
      cryptoStream.Write(plainBytes, 0, plainBytes . Length);
      cryptoStream.FlushFinalBlock();
      byte[] cipherBytes = memoryStream.ToArray();
      memoryStream.Close();
      cryptoStream.Close();
      string cipherText = Convert.ToBase64String(cipherBytes, 0, cipherBytes.Length);
      return Uri.EscapeDataString(cipherText);
  }

  public static string DecryptString(string cipherText, byte[] key, byte[] iv)
  {
      Aes encryptor = Aes.Create();
      encryptor.Mode = CipherMode.CBC;
      encryptor.Key = key;
      encryptor.IV = iv;
      MemoryStream memoryStream = new MemoryStream();
      ICryptoTransform aesDecryptor = encryptor.CreateDecryptor();
      CryptoStream cryptoStream = new CryptoStream(memoryStream, aesDecryptor, CryptoStreamMode . Write);
      string plainText = String.Empty;
      try {
          byte[] cipherBytes = Convert.FromBase64String(Uri.UnescapeDataString(cipherText));
          cryptoStream.Write(cipherBytes, 0, cipherBytes . Length);
          cryptoStream.FlushFinalBlock();
          byte[] plainBytes = memoryStream.ToArray();
          plainText = Encoding.ASCII.GetString(plainBytes, 0, plainBytes.Length);
      } finally {
          memoryStream.Close();
          cryptoStream.Close();
      }
      return plainText;
  }
}

```

### Java
```java title="EncryptDecrypt.java"
import java.nio.charset.StandardCharsets;
import java.security.MessageDigest;
import java.util.Arrays;
import java.util.Base64;
import java.util.Base64.Decoder;
import java.net.URLDecoder;
import java.net.URLEncoder;
import javax.crypto.Cipher;
import javax.crypto.spec.IvParameterSpec;
import javax.crypto.spec.SecretKeySpec;
import java.security.NoSuchAlgorithmException;
import java.math.BigInteger;

public class Playground {
    public static void main(String[] args) throws Exception  {
        String key_api =  "FjgHGLxnJO1qjlhHcK4KHg%3D%3D";
        String secret_api = "vqw330bxVfX9TEGMF1BDUKlVDm4DFejA0STb0WDarkU%3D";

        //For Encrypt Sample Data
        String data = "currency_code=THB&merchant_code=SKU20220913051108&merchant_api_key=FjgHGLxnJO1qjlhHcK4KHg%3D%3D&transaction_code=D996574709141&transaction_timestamp=1663729322&payment_code=PTHB07&bank_code=104&transaction_amount=500.00&user_id=4";

        //For Descrypt Sample Data
        String encryptData = "6mWOao2m34hP%2FZHQ%2F5skq5kTDuzWkHePH74pJsc4FTgmXqhidXtY4VLq9eW0N7%2FWDfY4gH2gHEVw8FU5d0LKpqc6mOc1gy8dhxyeT%2FlAyzaI0gnkXzRWwMm7pXlwNpoNG2v7%2FSXMCioAJMf3nLWEQji%2ByRTdBxietyMP8XArnQ2KJ%2F7IoOwQgxl6rPPGuHHCoi74POTI5lEzHbHCNDgGc4XjF89BQM0ROtlAyTpG%2BSTCtEYjE90crt%2FGaZwYkwCcaqgtFo8o%2FBNRZTDs4WcQOQCTyu2AnHtxdJvcPUgXAW%2BebPv91vNrwt68AmxcLhic";

        //Hash Key 32 Length
        final MessageDigest md_key = MessageDigest.getInstance("SHA-256");
        byte[] key_hash = Arrays.copyOfRange(md_key.digest(key_api.getBytes("UTF-8")),0,32);

        //Hash Secret 16 Length
        String sha_secret = hashsha256(secret_api).substring(0,16);
        byte[] iv_hash = sha_secret.getBytes("UTF-8");

        //Execute Test Scenario
        // String result = EncryptDecrypt("encrypt",data,key_hash,iv_hash);
        String result = EncryptDecrypt("decrypt",encryptData,key_hash,iv_hash);
        System.out.println(result);

    }

    static String EncryptDecrypt(String action, String data, byte[] key_hash, byte[] iv_hash) throws Exception {
        //Process OpenSSL EncryptDecrypt
        byte[] cipherText;
        String output;
        Cipher cipher = Cipher.getInstance("AES/CBC/PKCS5Padding");
        final SecretKeySpec key = new SecretKeySpec(key_hash, "AES");
        final IvParameterSpec iv = new IvParameterSpec(iv_hash, 0, cipher.getBlockSize());

        if(action == "encrypt"){
            //Encrypt condition
            cipher.init(Cipher.ENCRYPT_MODE, key, iv);
            cipherText = cipher.doFinal(data.getBytes("UTF-8"));
            output = Base64.getEncoder().encodeToString(cipherText);
            String result = URLEncoder.encode(output, StandardCharsets.UTF_8.toString());
            return result;
        }else{
            //Decrypt condition
            String decodeX = URLDecoder.decode(data, StandardCharsets.UTF_8.toString());
            byte[] decodeData = Base64.getDecoder().decode(decodeX);
            cipher.init(Cipher.DECRYPT_MODE, key, iv);
            cipherText = cipher.doFinal(decodeData);
            output = new String(cipherText,StandardCharsets.UTF_8);
            return output;
        }

    }

    static String hashsha256(String key) throws NoSuchAlgorithmException {
        MessageDigest md = MessageDigest.getInstance("SHA-256");
        md.update(key.getBytes(StandardCharsets.UTF_8));
        byte[] digest = md.digest();
        String key_string = String.format("%064x", new BigInteger(1, digest));
        return key_string;
    }
}
```

### Javascript
```javascript title="encrypt_decrypt.js"
var crypto = require("crypto");

const apikey = "myapikey";
const secretkey = "mysecretkey";

const encrypt_decrypt = (action, data) => {
  const encryptionMethod = "AES-256-CBC";

  const key = crypto.createHash("sha256").update(apikey).digest();
  const iv = crypto
    .createHash("sha256")
    .update(secretkey, "utf8")
    .digest("hex")
    .substring(0, 16);

  if (action == "encrypt") {
    const cipher = crypto.createCipheriv(encryptionMethod, key, iv);
    const res = encodeURIComponent(
      Buffer.from(
        cipher.update(data, "utf8", "base64") + cipher.final("base64")
      ).toString()
    );
    console.log(res);
    return res;
  } else if (action == "decrypt") {
    const buff = decodeURIComponent(Buffer.from(data));
    const decipher = crypto.createDecipheriv(encryptionMethod, key, iv);
    const res =
      decipher.update(buff.toString("utf8"), "base64", "utf8") +
      decipher.final("utf8");
    console.log(res);
    return res;
  }
};

// example to encrypt data
encrypt_decrypt(
  "encrypt",
  "currency_code=INR&merchant_code=SKU20230101012023&merchant_api_key=myapikey&transaction_code=TEST-DP-123&transaction_timestamp=1677495605&payment_code=PAY01D&transaction_amount=1000&user_id=test01"
);

// example to decrypt data
encrypt_decrypt(
  "decrypt",
  "QqqF5QD9NdtM1O5JCpySZXyFT0gmXvEgWUEgoW19xajeviLAAlwzdDJmD7sgE2laIp7iEt%2F1SzUpquHykjfQP2eTTQGyR3Jw60iVniAayGxBOQRoPW9ln%2FT4DzQkZL1eqapgcum%2FyGKLErYJ0v1WedA2nYZ%2Fd64vZISGh3eA2PqDGJdLZWYKbAP7uGHzMGBslmx8CcBCFbjrKvfA5VGam6LHi1ZWTfv8eeHmlBv4CSI6pXzhb43UZ22uBQj%2FN8rc6oJQd7l14FK2A4sZhpUhZQ%3D%3D"
);
```
