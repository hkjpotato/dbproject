# dbproject
This is a database course project by Kaijie Huang for CS4400 at Gatech.

The web application can be viewed on [52.24.114.125/dbproject](http://52.24.114.125/dbproject/index.php)

The web application is developed by Angular.js and jQuery for the front end, PHP and MySQL for the backend.

For a quick taste of the application, log in using
user : edo ; password : 1234
Once logged in, the system will recognize you as an inspector. Click the last blue button to display reports about complaints. For the search criteria, use 
year : 2015 ; min complaints: 0 ; max score : 100

You may enter more report to see the change.

The EER(Enhanced entity–relationship) diagram, information flow diagram as well as schema diagram for the database can be found in the document file.
The working SQL example are also provided.

The project requirements are as follows:

CS4400 Database Project: 
Georgia Restaurant Health Inspection System  
Summer 2015
Project Overview
The purpose of this project is to analyze, specify, design, implement, document, and demonstrate a database management information system called the Georgia Restaurant Health Inspection System.  The project will proceed in three phases as outlined in the Classical Methodology for Database Development: Analysis & Specification, Design, and Implementation & Testing.  The system should be implemented using a Database Management System (DBMS) that supports standard SQL queries.  Class administrators will provide you with information about how to access a college-managed MySQL server in order to implement your database.  Your professor must approve alternative implementations.  Under no circumstances may you use a tool that automatically generates SQL or automatically maps programming objects into the database.
The three phases of the project cover the following work-processes from the Classical Methodology for Database Development. The due dates for each phase appear in the table below.

Phase	Phase Description	Due Date
I	Analysis & Specification
II	Design
III	Implementation & Testing

Phase I – Analysis & Specification
The phase I include:
1.	An Information Flow diagram showing the primary documents and tasks of the system and the flow of data among them.  An example of this deliverable can be found in Appendix A – Sample Information Flow  Diagram.
2.	The data model for your system in the form of an Enhanced Entity Relationship (EER) diagram. The EER diagram must capture the constraints of the system as fully as possible. For example, all relationship types should have cardinality constraints, all keys should be identified, and total participation constraints should appear where applicable. An example of this deliverable can be found in Appendix B – Sample EER Diagram.
3.	A list of business constraints that will be enforced. Do not include any constraints that can be shown in the EER diagram, but rather business logic related constraints that cannot be expressed in EER. The constraints should be written in terms of the Entity Types, Relationship Types and Attributes of your EER diagram. An example of this deliverable can be found in Appendix C – Sample Constraints.
4.	A list of any assumptions made, including explanations. You are allowed to make up additional reasonable assumptions and constraints as long as they do not conflict with the specified constraints and requirements.  If possible, those additional assumptions and constraints should be included in the EER diagram.
Phase II – Design

The phase II deliverables include:
1.	A list of contributions of each team member.
2.	A relational schema diagram with primary and foreign keys identified and referential integrity shown by arrows. An example of this deliverable can be found in Appendix D – Sample Relational Model Diagram.
3.	CREATE TABLE SQL statements, including domain constraints, integrity constraints, primary keys, and foreign keys. An example of this deliverable can be found in Appendix E – Sample CREATE TABLE Statements.

Phase III – Implementation & Testing
Implement a working application including a graphical user interface (GUI) with all functionality described in the project description. Under this option, the SQL statements will be embedded in a host language, such as PHP or Python.
For both lightweight and heavyweight options, you will need to generate sample data for your database, which will be used for your demo.
The deliverables for phase III include:
1.	A relational database pre-populated with sample data.
2.	A set of working SQL statements for all tasks (lightweight option).
3.	A functional application with embedded SQL statements (heavyweight option).

The Database Application Description
Overview of the Georgia Restaurant Health Inspection System (GRHI)
The Georgia Restaurant Health Inspection system (GRHI) is a database application for managing and sharing information about health inspections for restaurants in the state of Georgia.
The Georgia Department of Health Services (GDHS) inspectors conduct unannounced inspections of all food service establishments. The ultimate goal of GDHS is to protect the public by preventing food-borne illnesses. GDHS has contracted with CS 4400 to develop a database system to store all related data about the inspections in a publicly accessible database which can be updated/queried online. 
Each food service establishment in the state of Georgia is inspected at least once every twelve months and additional inspections are made as necessary based on the public health risks posed by the establishment and the establishment's past compliance history. The inspector may enter any food establishment at any reasonable time after proper identification. They are also permitted to examine the records pertaining to food and supplies purchased, received or used, or to persons employed. 
During the inspections, the inspectors evaluate food handling practices, how food is received and stored, how food is prepared, processed and served, how is food cooked, held and cooled for future use. The inspectors also check for deficiencies in the facilities and pest related violations.  After conducting an inspection of a restaurant, the inspector will calculate a score based on the violations observed.  Violations can fall into two categories: 
•	Critical: Violations that directly relate to the transmission of food borne illnesses, the adulteration of food products and the contamination of food-contact surfaces. 
•	Noncritical: Violations that are of a moderate/low risk to the public health and safety. 
The findings of an inspection are to be recorded in a database. The inspection report and related information are public record and can be reviewed by anyone. 
The GDHS inspection is based on a 15-item checklist. Eight of those items are considered “critical” and address areas where there is a high likelihood of illness if left uncorrected. Appropriately, these critical items are weighed heavier in our analysis. The remaining seven “non-critical” items measure construction and overall cleanliness. When totaled, the 15 checklist items together add up to a perfect score of 100. Each of the eight (8) critical items has a perfect score of 9 and the seven (7) noncritical items have a perfect score of 4.
To pass the inspection, food establishments must have a score of 75 or better and have no critical item score less than 8. If these criteria are not met, the establishment will be asked to voluntarily close its doors until it can open again in full compliance as shown by passing a subsequent inspection.
Inspection Checklist items (first 8 are critical items) 
1.	The food is in good condition and safe for human consumption
2.	Potentially hazardous food is stored, prepared, displayed  and served  according to specified time and temperature requirements
3.	Cross-contamination is prevented
4.	Personnel with infections or communicable diseases are restricted from handling food 
5.	Personnel wash hands and use good hygienic practices
6.	Food equipment and utensils are properly sanitized
7.	Hot and cold water is from a safe and approved source
8.	Insects, rodents and other animals are kept out of the restaurant 
9.	Proper equipment is used to maintain product temperature
10.	Gloves or utensils are used to minimize handling of food and ice
11.	Dishwashing facilities are properly constructed and maintained
12.	Restrooms are clean, properly maintained
13.	Rubbish containers are covered and  properly located 
14.	Outside garbage disposal areas are enclosed and clean
15.	Non-food contact surfaces of equipment and utensils are clean and free of contaminants
The key players in this system are restaurants, inspectors and customers.  Restaurants are required to have a current Health Permit issued yearly by the state and a passing Health inspection score to be able to operate.  Information about the restaurant operator  is also stored in our system.  All restaurants also have a unique state ID identifying the establishment in the state of Georgia. Other related information will be shown in the GUI for entering restaurants into the system. The second type of player is the Inspector.  Each inspector has a unique state health inspector ID and an associated name and telephone number.  The third type of player is the Customer.  Customers are included because our system will allow customers of a restaurant to enter food/safety complaints about the restaurant.  We do not include general restaurant reviews.  Customer information will include contact information such as  name and telephone number.
The following sections contain a functional description of the GRHI application along with some very simple screen mockups.  We should note that we will not implement a complete real-world system for this application but rather a subset of the system that is described in this document. The user interfaces depicted in this project description merely serve as examples to guide your thinking.  Your project’s interface may look completely different and that is fine—even encouraged!  For example, you might choose to split up some interfaces we have shown on a single screen into multiple screens.  You might choose to use popup windows instead of refreshing the page.  A complete reorganization of the user interface is acceptable as long as your application supports the same functionality as described below.  If you choose the heavyweight option, you may implement the project as a traditional standalone application (e.g., using Python or Java GUIs) or as a web application (e.g., using a web scripting language like PHP). Your project is not graded on its aesthetic appeal, but on its functionality as it relates to the application requirements.
Logging In 
The GRHI login screen is shown in Figure 1.   Restaurant operators and state health inspectors can log into the system and are required to enter a password for the security of the database.  Others who are just looking for restaurant  inspection reports/scores  can simply login in as a guest.   In addition a customer who wishes to file a complaint about a restaurant can also login as a guest. We will assume that restaurant operators and inspectors have received a user name and password from the State Health Department and that action is outside the scope of our system.  When applying for a username/password 
•	the restaurant operator is required to submit their name (first and last), phone and email.  This information will be stored in the database.  
•	the health inspector is required to submit their name (first and last), and phone. This information will be stored in the database.  
If invalid login credentials are input by a restaurant operator or inspector,  an error message should be displayed and the user should be asked to retry.  
 
Figure 1 – General GRHI Login Screen
Guest Access  
After a guest logs in to GRHI, he or she is directed to the Guest Menu. The Guest Menu (not shown) gives the user two general options: searching for restaurants and filing a complaint.  In addition the user may exit the system from this screen.  The first option (figure 2a) allows users to find a restaurant(s) based on the conjunction of health inspection score and zipcode with  (0, 1 or both) of the following: restaurant name,  cuisine.  With score, there is a dropdown box that allows the comparison to be less than  or greater than. The cuisine option is also a dropdown box where the user can choose from a list of cuisines.  The search result is shown in Figure 2b where restaurants are listed in descending order of score. 

Figure 2a – Restaurant Search

Figure 2b – Restaurant Search Results

Figure 3 – Food/Safety Complaint Screen
Restaurant Operator  Access  
After a restaurant operator logs in to GRHI, he or she is directed to the Restaurant Operator's Menu.  The Restaurant Operator's  Menu (not shown) gives the user  two general options: inserting information about their restaurant  (figure 4) and displaying health inspection report results for the last two inspections (figures 5a and 5b).   Once the information is submitted  in figure 4, the system will generate a unique ID for the restaurant.  In Figure 5a,  the user will select the search criteria from a dropdown that lists all the restaurant information associated with him/her. 
	
Figure 4 – Restaurant Information Input Screen

Figure 5a – Restaurant Health Inspection Search Criteria 

Figure 5b – Restaurant Health Inspection Search Results 

Figure 6a - Inspection Report

For figure 6a, each Inspector will enter the results of their inspection of a particular restaurant as shown.  Inspector information such as Inspector ID, Name (first and last) and phone number is entered in our system by the State Health Department.   The inspector will enter their Inspector ID, Restaurant ID and date along with the score for each of the 15 items.   To ensure data integrity, the score for items 1 through 9 should be restricted to integer values from 0 to 9 and the score for items 10 through 15 should be restricted to integer values  from 0 to 4.  The other information such as Item number, Item Description and Critical/NonCritical designation will retrieved from the database for this screen. 

Figure 6b – Item Comments for Inspection Report
In figure 6b, an Inspector can enter additional comments about the observed condition of any item on the inspection list.   He/she will enter Inspector ID, Restaurant ID, Date and Item number with associated Comments. 

In figure 7a, an inspector can run a summary report about restaurant inspections for a specified month and year.   The summary data is organized by County and Cuisine in sorted order. 

Figure 7a – Inspection Summary Report by County/Cusine 

In figure 7b, an inspector can run a summary report about restaurant inspections for a specified county and year.   
Figure 7b – Inspection Summary Report by Month for a specified Year/County

In figure 7c, an inspector can run a summary report for a specified county and year listing the restaurant with the top health inspection rating for the year by cuisine. 

Figure 7c – Inspection Summary Report for top Restaurant by Cuisine for a Year/County 

In figure 7d, an inspector can run a summary report listing restaurants and customer complaints for restaurants with number of complaints ≥ a specified number of complaints and an inspection score ≤ a specified inspection score on their last inspection where a less than perfect score was given on at least one critical item. 

Figure 7d – Inspection Summary Report for Restaurants with Complaints

End of Database Application Description 
Appendix A – Sample Information Flow Diagram




