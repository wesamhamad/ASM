# Appointment Management System

## Table of Contents
1. [Introduction](#introduction)
2. [Features](#features)
3. [Use Case Tables](#use-case)
4. [Database Schema](#database-schema)


## Introduction

The Appointment Management System is designed to streamline the process of scheduling, managing, and viewing appointments within an academic institution. The system caters to three primary user roles: Students, Coordinators, and Deans. Each role has specific functionalities and access privileges to ensure a seamless and efficient appointment management experience.

## Features

- User Registration and Login
- Appointment Reservation for Students
- Appointment Management by Coordinators
- Appointment Viewing for Deans

Below you will find the use case tables and a database schema to help understand the project's structure and functionality.

## Use Case 

### 1. User Registration and Login

#### UC-001: User Registration
- **Actor:** Student, Coordinator, Dean
- **Precondition:** None
- **Main Flow:**
  1. User navigates to the registration page.
  2. User fills in registration form with name, email, password, and role.
  3. User submits the form.
  4. System validates the form and creates a new user record.
- **Postcondition:** New user account is created.

#### UC-002: User Login
- **Actor:** Student, Coordinator, Dean
- **Precondition:** User has an existing account
- **Main Flow:**
  1. User navigates to the login page.
  2. User enters email and password.
  3. User submits the login form.
  4. System validates credentials.
  5. System grants access to the user and redirects to the dashboard.
- **Postcondition:** User is logged in and redirected to their dashboard.

### 2. Appointment Reservation

#### UC-003: Reserve Appointment
- **Actor:** Student
- **Precondition:** Student is logged in
- **Main Flow:**
  1. Student navigates to the appointment reservation page.
  2. Student selects a dean from the list.
  3. Student selects an available time slot.
  4. Student submits the reservation request.
  5. System saves the reservation and confirms the appointment.
  6. 
- **Postcondition:** Appointment is reserved.

#### UC-004: View Reserved Appointments
- **Actor:** Student
- **Precondition:** Student is logged in and has reserved appointments
- **Main Flow:**
  1. Student navigates to the "My Appointments" page.
  2. System displays a list of all reserved appointments for the student.
- **Postcondition:** Student views their reserved appointments.

### 3. Appointment Management by Coordinator

#### UC-005: View Appointments for Dean
- **Actor:** Coordinator
- **Precondition:** Coordinator is logged in
- **Main Flow:**
  1. Coordinator navigates to the dean's appointment management page.
  2. System displays a list of all appointments for the affected dean.
- **Postcondition:** Coordinator views all appointments for the dean.

#### UC-006: Update Appointments
- **Actor:** Coordinator
- **Precondition:** Coordinator is logged in and viewing appointments
- **Main Flow:**
  1. Coordinator selects one or more appointments to update.
  2. Coordinator makes necessary changes (e.g., reschedule, cancel).
  3. Coordinator submits the updates.
- **Postcondition:** Selected appointments are updated.

### 4. Dean Views Appointments

#### UC-007: View Appointments
- **Actor:** Dean
- **Precondition:** Dean is logged in
- **Main Flow:**
  1. Dean navigates to their appointment overview page.
  2. System displays a list of all upcoming appointments for the dean.
  3. Dean can filter or search for specific appointments. 
- **Postcondition:** Dean views all relevant appointments.

#### UC-008: Filter Appointments
- **Actor:** Dean
- **Precondition:** Dean is logged in and viewing appointments
- **Main Flow:**
  1. Dean applies filters (e.g., date range, student name).
  2. System displays filtered list of appointments.
- **Postcondition:** Dean views filtered list of appointments.

## Database Schema
![AMS_Database Schema](https://github.com/wesamhamad/ASM/assets/74800962/845a227d-e517-4875-83e8-4761382b1687)


