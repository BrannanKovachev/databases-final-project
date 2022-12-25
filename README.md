# Puppy Provenance
My final Project written for my Databases Class in concert w/ Robert Hughes.

TLDR:
Provides SQL for creating database tables and inserting example data.

Creates a simple browser CRUD for interacting with a multi-table database. The database is an immitation of what one might implement should they have a dog breeding business and need to keep track of puppies, parents, and clients.

Provides sample complex queries for demonstration of understanding of SQL.

---
‘Puppy Provenance’ is the start of a theoretical web app for a Dog Breeding Business. 
The CRUD and integrated Database allow an Administrator to add Puppies to their inventory as needed. 
Each Puppy’s list of relevant fields can be updated, barring those relevant to the primary key or otherwise logically immutable (such as gender). These fields are referenced in a few scenarios such as determining the Puppy’s price or finding the names of its parents. 
Should it be desired to delete a Puppy from the table, whether it is due to an error on an immutable field or a real-world change in circumstances, the user can do this from the main Read page as well.

Notes on Adding a Puppy:
When adding a Puppy, user input determines a number of fields however some fields are purposefully set to NULL as the application makes the assumption that these fields are unknown. These fields are the eventual reserving client’s ID, whether they would like to license the Puppy, and whether the Puppy was delivered to them. However, these remaining fields can easily be updated by selecting the ‘Edit’ button on the relevant Puppy in the main table once the real world events have resolved themselves.
For Reference:
Brannan was responsible for the CR and Robert was responsible for the UD.

![image](https://user-images.githubusercontent.com/69013824/209454333-114acc51-43cd-4a3c-bd79-aaa426a2f4bc.png)

![image](https://user-images.githubusercontent.com/69013824/209454337-eb3466cd-2dfc-4ee3-9f12-36942fc8b4aa.png)

![image](https://user-images.githubusercontent.com/69013824/209454339-1c3f762e-47e8-4fd6-be90-bf2fd7b97542.png)

![image](https://user-images.githubusercontent.com/69013824/209454340-468c5f7b-4057-4b2a-97d3-fc65f9d13dfb.png)

![image](https://user-images.githubusercontent.com/69013824/209454343-523b1c78-d971-4cf2-b9b0-ef9222d45fd1.png)
