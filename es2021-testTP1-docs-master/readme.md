# ES2021 - Back-end Training project #1

## Introduction

WorldSkills International would like to create a web application to manage the booking process for Restaurant Service during a WorldSkills Competition. This tool will be used to request booking to participate as fake clients in the Restaurant Service competition.

This test project focuses only on the API part of the app, the front-end part will be developed by a third-party company using the API you will provide.

During the 4 days ("C1/C2/C3/C4") of the Restaurant Service competition, competitors must work on 4 different service modules. Those modules are described below, along with their internal unique code name.

- **Casual Dining** : 2 services per day (*CD1 / CD2*) - 5 tables of 2, and 5 tables of 4 guests (30 guests per service)
- **Bar Service** : 1 service per day (*BS1*) - 5 tables of 4 (20 guests per service)
- **Fine Dining** : 1 service per day *(F1)* - 3 tables of 4 (12 guests per service)
- **Banquet Dining** : 1 service per day (*BD1*) - 2 tables of 6 (12 guests per service)

Therefore, during the whole competition, 20 services will be provided, and up to 416 guests will be able to enjoy the finest food, beverages and service.

This API must allow individuals or WSI member countries representatives to book a seat for themselves (individual user) or a group of compatriot guests (WSI representatives).

## Provided documents :

[https://github.com/worldskillsfrance/es2021-testTP1-docs](https://github.com/worldskillsfrance/es2021-testTP1-docs)

- Expected API Routes documentation
- Draft database schema as .sql file

## Task List

WSI expects you to :

- Acquaint yourself with a draft database schema and seed data that a fellow Back-end developer made. You can use it *as is*, or modify it to match your needs.
    - Be aware that you need to maintain a correct normalization in order to avoid useless data copy or performance issues.
- Seed the database with missing data (tables, services...) to match the test project specifications.
- Implement the required API routes, using these specifications :
- **Authentication & Authorization**
    - The authentication is made through a **/api/v1/login** endpoint (see documentation for usage). This route, obviously, does not require to be authenticated.
    - If the authentication is successful, a token is randomly generated passing the concatenation of the username and the current timestamp to the md5 function. It is stored in the database, and is valid for 3 hours (this has to be stored in the database).
    - This token must be passed to every request that needs it through the Authentication header as a Bearer token.
    - Following the login, every successfully authenticated request **except the logout one** puts the expiration time back to 3 hours. This ensures the user will have to provide again his credentials only if he's AFK for more than 3 hours.
    - Each user can be granted with custom scopes :
        - `user:validate` : The user can validate the account of a newly registered other user.
        - `booking:self` : The user can book a seat on a service with remaining vacancy, only for himself.
        - `booking:group` : The user can book for a list of guests from his Member Country.
        - `booking:admin` : The user can accept/decline every bookings.
        
        You can consider that a user cannot be granted both `booking:self` and `booking:group` permissions. If a user wants to book both for himself and others, he will have to use 2 accounts.
        
        In the documentation, the potential required scopes are provided for each request. If an authenticated user performs a request for which he does not have the required scope(s), a 401 HTTP response must be sent.
        
    - Every authenticated user must have the ability to logout, using the **/api/v1/logout** endpoint. This must clean the token, and user will have to login again.
    - The API also provides a **/api/v1/register** endpoint. This allows users to register to the API. Keep in mind that by default, while waiting for an administrator (being granted with the `user:validate`  scope) to accept or decline the user creation, this user isn't given any scopes.
        - When an administrator validates the account creation using **/api/v1/user/{userId}/validate** endpoint, if the user registered as an individual, he is given the `booking:self` scope. Otherwise, as a Member Country Representative,  `booking:group` is granted.
        - The country code provided when registering must exist in the database table. If an incorrect country code is supplied, a HTTP 422 Error must be thrown.
        
- **Seat booking**
    - A **/api/v1/services** GET endpoint can provide the whole services list, and for each one their basic data and current availability (each table with its ID and number of free seats) without authentication. As an insecure route, this endpoint does not have to provide the identity of registered guests.
    
    For a table, "free seat" refers to the total table seat count, minus the approved and pending seat bookings. Per example, if a table has 6 seats, 3 approved bookings, 2 pending bookings and 4 denied bookings, it has 6 - 3 - 2 = 1 free seat.
    
    - A **/api/v1/admin/services** GET endpoint (requires `booking:admin`) returns the same data, including the tables detail and guests identities (booking id for guest, first name, last name, country code, booking status : pending or approved).
    - A **/api/v1/services** POST endpoint allows a user to create a booking.
        - For an individual user, the request payload contains a table ID (fetched from the **/api/v1/services** endpoint). If this table does not have any available slots (it has to be checked again at this time), an error is returned. The booking is filled with the currently logged in user's information (first name, last name, member country code).
        - For a representative, the request payload contains an array of tables. In each table, an array of guests is provided (each one containing first name, last name, country code as required fields).
            
            Users created during a group booking don't have the ability to login. Only the generated booking database tuple contains this information.
            
            - If at least a table does not have enough available slots to satisfy the booking (it must be check again at this time), an error must be returned.
            
        - In both cases, the booking has 3 statuses :
            - Pending (default) : awaiting confirmation from the WSI admin (see below).
            - Approved
            - Denied
        
    - A **/api/v1/admin/booking** GET endpoint allows an admin having `booking:admin` to get a list of individual and group bookings, including for each : table ID, service ID, module, guest identity and country.
        - By default, it shows only the pending bookings. It can be overriden to show the approved or denied ones using a "status" queryString.
        - For a guest belonging to a group, the groupId field must also be non-null in order to be able to display all the guests in a single group in the front-end application. You can store it on the database, or generate it on the fly'.
    
    - A **/api/v1/admin/booking/{bookingId}** PUT endpoint allows an admin having `booking:admin` to change the status of a single booking. This endpoint may only be used on a pending booking, otherwise it must return a HTTP 400 error.
    
    - A **/api/v1/admin/booking/bulk** PUT endpoint allows an admin having `booking:admin` to change the status of an array of bookings. If any booking is not pending, no booking must be updated and a HTTP 400 error must be thrown.
    

## General instructions

- Unless specifically required by the Test Project or the API documentation, fields validation is not required.

## Time to complete the Test Project

The time to complete the Test Project is **two hours.**
