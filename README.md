Steps to setup project 

## clone the repository
```cmd
git clone https://github.com/pyofficial/user-activity-task.git
```

## Database migration 
```cmd
php artisan migrate
```

## Seed database using seeder 
```cmd
php artisan db:seed --class=UsersActivitySeeder
```

# Approach for calculating leaderboard 
    
- Every time when user perform any activity Entry will be created in **user_activities** table on that created & update operation **Event will be called event mentioned in Boot method** 

- **EventName -: UserActivityPerformed**
- **EventListner -: UpdateLeaderboard**


## Table schema

**Tables I've used**
    
- Users 
    - id
    - full_name
    - email
    - created_at
    - updated_at
    - deleted_at

- Activities
    - id
    - name
    - completion_points     ***Taken this column for future if we need to mention different points on different activities***
    - created_at
    - updated_at
    - deleted_at

- User Activities
    - id
    - user_id            ***users table id***
    - activity_id        ***activities table id***
    - performed_at       ***Date activity started to perform***
    - sttus              ***We can track task is completed or not for now it's boolean 0 OR 1***
    - points             ***it's for future purpose but also used now. When user started the task points will be 0 on completion points will be according to activities table dynamic***
    - created_at
    - updated_at
    - deleted_at

- Users Leaderboard
    - id
    - user_id            ***users table id***
    - total_points       ***user total points will be clacuted form user_activites table***
    - rank               ***which will be updated by the event eventually.**
    - created_at
    - updated_at

- I've deicided to give filter from **user activites** table **performed_at ** column as it's saving datetime
