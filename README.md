# Laravel Real-Time Notifications with Pusher

This project demonstrates how to build a real-time notification system using **Laravel** and **Pusher**. It's ideal for applications that require instant updates, like messaging systems, alerts, or collaborative tools.

---

## 🚀 Features

- Real-time notifications using [Pusher](https://pusher.com/)
- Laravel event broadcasting
- Clean UI with Toastr notifications
- Example of public and private channels
- Fully working Laravel app with authentication

---

## 🛠️ Tech Stack

- **Laravel 10+**
- **Pusher Channels**
- **Laravel Echo**
- **Toastr.js** for frontend notifications
- **Bootstrap** or your preferred frontend framework

---

## 📦 Installation

### 1. Clone the repository
```bash
git clone https://github.com/your-username/laravel-realtime-notifications.git
cd laravel-realtime-notifications

### Set Pusher credentials in .env
BROADCAST_DRIVER=pusher

PUSHER_APP_ID=your_app_id
PUSHER_APP_KEY=your_app_key
PUSHER_APP_SECRET=your_app_secret
PUSHER_APP_CLUSTER=your_cluster
