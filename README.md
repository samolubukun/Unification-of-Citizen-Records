# Unification-of-Citizen-Records
The project uses a web application to simulate and provide a framework for unifying citizen records from NIMC, FRSC, INEC, and Immigration, while making sure that each agency has access to only information that pertains to them from the unified citizen’s record.  



https://github.com/samolubukun/Unification-of-Citizen-Records/assets/137217836/16982a3a-0c1b-4462-bfce-7f7420f84fcf


https://github.com/samolubukun/Unification-of-Citizen-Records/assets/137217836/82af60ff-2a0d-409f-a6cd-fb6d26b9ddb5



https://github.com/samolubukun/Unification-of-Citizen-Records/assets/137217836/456cefc6-755a-4574-bb3f-2989818301cb



National Citizens Record Unification Project (NCRUP)

The project uses a web application to simulate and provide a framework for unifying citizen records from NIMC, FRSC, INEC, and Immigration, while making sure that each agency has access to only information that pertains to them from the unified citizen’s record.  

The program displays a representation of the various agency databases and a unified (central) database, it uses a unique identification number called the UCR number (UCR means unified citizen records) as a unique identification number for each citizen for the unification and harmonization of citizen records across the agencies.





Overview of How the Web App Achieves the Framework for the Unification of Citizen Records Across the Four Agencies         (NIMC, FRSC, INEC, and Immigration).

o	Folder Structure: The project's folder structure organizes the codebase into separate folders for each agency (NIMC, FRSC, INEC, and Immigration) and a folder for unified citizen records (UCR). Each agency folder contains PHP files responsible for CRUD operations on their respective agency databases. The UCR folder has PHP files for connecting to the database and displaying unified data.

o	Agency Databases: Within the database, there is a separate table for each agency (NIMC, FRSC, INEC, Immigration). These tables store the relevant citizen data specific to each agency, allowing for agency-specific operations and maintenance of their individual records. The agency tables primary key is the UCR number, providing a unique identifier for each citizen record.

o	Unified Citizen Records (UCR) Table: In addition to the agency tables, there is a unified citizen records table. This table serves as a centralized repository for citizen data across the four agencies. It contains records that are common to all agencies, enabling data integration and ensuring consistency across the system. The UCR table's primary key is the UCR number, providing a unique identifier for each citizen record.

o	Triggers: Triggers are set up in the agency tables to automatically update the unified citizen records table whenever any operations such as insertions, updates, or deletions occur. These triggers ensure that changes made to the agency tables are reflected in the unified records, maintaining data synchronization across all agencies. Whenever an agency's table is modified, the corresponding trigger initiates the necessary updates in the UCR table, ensuring the unified view of citizen records remains up to date.

o	Web Interface: The index.php file serves as the main entry point for the web application. It contains an HTML and CSS web page with buttons representing the four agencies. By clicking on a button, users can access the respective agency's database, where they can perform CRUD operations on the specific agency's citizen data.

o	UCR Display: The UCR folder's display.php file is responsible for presenting the unified citizen records in a consolidated view. It connects to the UCR table in the database and retrieves the data, providing users with a comprehensive display of citizen records across all agencies.

	By employing this web app framework, I have created a system that brings together citizen records from multiple agencies, enabling efficient data management, synchronization, and access across the four agencies involved. Users can interact with individual agency databases while also having access to a unified view of citizen records, ensuring consistency, and facilitating the unified management of citizen data. The use of triggers ensures that changes made in the agency tables are automatically propagated to the unified records, simplifying the maintenance of a synchronized and up-to-date database. Having the UCR number as the primary key in the agency tables allows for efficient retrieval, updating, and referencing of individual citizen records within each agency's database. It ensures that each agency has a consistent and unique identification system for its citizen records.


NOTE:

Refer to the Documentaion.docx file for detailed Instructions, description and information!!!
