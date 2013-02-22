Filter My XML
==========
A little programming test given by an Amsterdam based company. I had very little PHP experience till that point, so I decided to do the assignment for myself. Here's the actual task:  
You are asked to create a small website where a file with personal data can be uploaded, filtered for doubles and then downloaded.
###Page 1: Upload form 
The first page of the website contains of a small upload form, that should look like this:  
>**Upload a XML file with addresses**  
Use the form below to choose an XML file from your hard disk and upload it to the server. The XML file contains a number of records with contact data of persons.   
**File:**

Below you'll find an example XML file that you can use to upload to the form. For testing we use much longer XML files.
```xml
<data>
  	<record>
		<name>Company A</name>
		<address>Wilhelminastraat 1</address>
		<city>Haarlem</city>
		<email>info@companyA.com</email>
		<telephone>+31201234567</telephone>
	</record>
	<record>
		<name>Company B</name>
		<address>Wilhelminastraat 1</address>
		<city>Haarlem</city>
		<email>info@companyB.com</email>
		<telephone>+31201234444</telephone>
	</record>
	<record>
		<name>Company C</name>
		<address>Example street 11</address>
		<city>Amsterdam</city>
		<email>info@companyC.com</email>
		<telephone>+31201234555</telephone>
	</record>
<data>
```
###Page 2: Error page
If you have uploaded an invalid file - for example a PDF file instead of a XML file, or a file that does not contain valid XML, you should be redirected to a page that looks like this:

>**Error**   
The file that you uploaded did not contain valid XML code.  
[Click here to upload a new file.]()

###Page 3: Filter page
After a valid file was uploaded, the user is directed to a page where he can filter the uploaded file and remove all double addresses from it. With checkboxes he can specify the fields on which the file should be filtered.
>**Remove doubles**   
The file that you uploaded contains **12345** records. You can now remove all doubles from this file. Use the checkboxes to specify the field or the combination of fields that should be unique.  
 - Name  
 - Address
 - City
 - Email
 - Telephone

>Based on the checkboxes that you have selected, **345** doubles were removed and the file now contains **12000** unique records.

In the example above, the numbers **345** and **12000** are dynamic fields. When an extra checkbox is checked or unchecked, it should automatically be updated using Ajax call to find out the number of unique records, based on the combination of fields that have been selected.  
After the submit button is clicked, an automatic download should start with the new, filtered, XML file.

###Points of attention   
We do not only check if your solution actually workds, but we also - and mainly - look at how it was implemented, like coding style, the use of object orientation, how you separated programming code (PHP) and user interface code (HTML, Javascript), and if you took care of security: it should of course not be possible to access data that was uploaded by parallel sessions.   
We want your solution to work right out of the box. This means that you should not be using specific frameworks, or make assumptions about out server configuration. If you need to srote files at any location, you can only do this in the /tmp directory. There is no database available for storage. The functions from the libxml and libxslt libraries are available in PHP (simpleXML, xsl, DOM, XML Parser, XMLReader and XMLWriter).