1. You are tasked to create a microservice to process users data and user orders data. Both
of these data is obtained through endpoints, not database access. One of the important steps
of the data processing is to match each user with the user orders data. Assume that both data
is already in-memory in the form of lists. How do you achieve the matching step?

Answer: Membuat service yang mana akan mengecek/memproses data dari endpoint yang sudah tersedia yaitu users data and user orders data


2. You are tasked to create a brand new microservice for user domain (does anything that
has to do with users data). The obvious task of the microservice is to save a newly registered
user to the database. However, the product owner comes to you with the following additional
requirements :
- After the user is successfully registered, send email to the marketing department, to
notify them of a new user
- After the user is successfully registered, send a welcome email to the user

Assume that the related functions/methods already exists, and you just have to execute it.
How do you achieve these requirements?

If, say, the project manager comes to you in the future with new tasks relating to successful
user registration, how do you add these tasks to the list of execution? (assume that the
functions/methods already exists). Let&#39;s say, as it goes, there are about 50-ish related tasks
that need to be done right after the user has successfully registered.
You are free to propose a new approach/design. Please explain your approach.

Answer: Buat endpoint register user, lalu jalankan task-task tersebut dalam sistem antrian/message broker. Di dalam sistem antrian tersebut akan menjalankan fungsi-fungsi seperti kirim email ke departmen marketing, kirim email ke user, dan fungsi-fungsi untuk task lainya.,
