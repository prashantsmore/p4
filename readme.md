# Final Project		
+ By: *Prashant More*
+ Production URL: <http://p4.dwa15.online>

## Outside resources
+ Icons: [Font Awesome](https://fontawesome.com)
+ CSS: [Bootstrap CDN](https://www.bootstrapcdn.com) & [CSS ZEN Garden](http://csszengarden.com)
+ Image: <https://www.google.com/search?q=project-staffing+jpg&tbm=isch&tbo=u&source=univ&sa=X&ved=0ahUKEwjzqcGG9fnaAhWEuVkKHWRuDKkQsAQIOQ&biw=1366&bih=606#imgrc=uipMv7v2P-ZzhM:>


## Database
*Employee Data is stored in the `users` table. The skill  are stored in  the `skills` table.*
*The pivot table `employee_skill` stores  employee with skills with many-to-many relationship*
*The Staff 

Primary tables:
  + `employees`
  + `skills`
  + `staff_requests`
  
Pivot table(s):
  + `employee_skill`


## CRUD
*The system allows to view, add , update and delete employees and its corresponding skills. *

__Create__
  + To add new employee ,please use the following link - <http://p4.dwa15.online/employees/create>
  + This function is also available as *Add Employee* on the Home Page <http://p4.dwa15.online/>
  + Add details like staff identification, name, address and one or more skills
  + Click *Add Employee*
  + If validation is successful, successful message is displayed  and the user is redirected to *Manage Employee* page
  + In case of errors, system will remain on same page with validation errors.
  
__Read__
  + To view existing employees and manage them , please use the following link - <http://p4.dwa15.online/employees>
  + This function is also available as *Manage Employees* on the Home Page <http://p4.dwa15.online/>
  + There are two sections displayed here, first show recently added or assigned to open request employees.
  + The next section shows the complete list of employees in the application.
  
__Update__
  + You can update the employee details by clicking on the corresponding link *Edit*, adjacent to each employee in the Complete Employee List Section.
  + Also the recently updated employee can be modified from the first section of the *Manage Employee* section.
  + Edit Employee Details and  their corresponding skills.
  + Click *Save Changes*
  + If validation is successful, successful message is displayed and  system will keep you on same page to allow more edits if required.
  + As part of core function, the open staffing requests can be assigned to matching employees based upon their skills.
  + Once Updated, the fulfilled staffing request disappears from the Unfulfilled List.
  
__Delete__
  + You can delete the employee details by clicking on the corresponding link *Delete*, adjacent to each employee in the Complete Employee List Section.
  + Confirm deletion on delete page.
  + Follow the confirmation message to confirm or cancel delete action.

## Code style divergences
n/a