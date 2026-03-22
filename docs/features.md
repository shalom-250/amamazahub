# Platform Features

## 🎬 Video Feed (Home Page — `/`)

The home feed is the core of AmazamaHub. It shows short-form videos in a vertical scrolling layout (like TikTok).

### Feed Types
| Type | URL | Description |
|---|---|---|
| For You | `/?type=foryou` | Personalized feed based on location & follows |
| Following | `/?type=following` | Only videos from accounts you follow |

### How "For You" Works
1. Videos from people you **follow** who are in your **same city** → shown first
2. Videos from people you **follow** → shown second
3. Videos from creators in your **same city** → shown third
4. All other videos → fill the rest of the feed
5. Each group is **randomly shuffled** on every refresh for freshness
6. **Infinite scroll**: when you reach the bottom, the next page loads automatically

### Video Interactions
- **Single tap** → Play / Pause
- **Double tap** → Like (with heart animation)
- **Like button** → Toggle like
- **Comment button** → Open comment drawer
- **Bookmark button** → Save for later
- **Repost button** → Share to your followers
- **Share button** → Copy link or native share

---

## 🔍 Explore Page (`/explore`)

A grid of short videos for discovery.

- **Hover over a video** → Muted preview starts playing
- **First video** → Auto-plays immediately
- **Click a video** → Opens full video with sound
- Videos are loaded from all creators on the platform

---

## 🔴 Live Streaming (`/live`)

Broadcasters can go live and interact with viewers in real time.

### Creating a Live Stream (`/live/create`)
- Set a **title** and **description**
- Upload a **thumbnail** (or the platform logo is used by default)
- Choose whether to show your **location**
- Click **Go LIVE** to start

### Viewing a Live Stream
- See the live video feed
- Send **real-time chat messages**
- React with **likes**
- Stream host can **end the broadcast**

---

## 👤 Profile (`/profile`)

Each user has a public profile showing:
- Avatar, name, username, bio
- Location (city)
- Follower / Following counts
- All uploaded videos

### Edit Profile (`/profile/edit`)
- Update avatar (upload image)
- Change name, username, bio

---

## ⚙️ Settings (`/settings`)

| Setting | Description |
|---|---|
| Language | Toggle English / Kinyarwanda |
| Location | Set your city (affects "For You" feed & Suggestions) |
| Dark Mode | Toggle dark/light interface |
| Push Notifications | Enable/disable notifications |

All settings are saved to the database instantly (no separate save button needed).

---

## 💬 Messages (`/messages`)

- Direct messaging between users
- Real-time indicator for unread messages in the Navbar
- Message types: text

---

## 🔔 Notifications (`/notifications`)

System notifications for:
- New followers
- Likes on your videos
- Comments on your videos

---

## 👥 Location-Based Suggested Accounts (Sidebar)

The right sidebar shows "Suggested Accounts" using a smart algorithm:
1. Users in the **same city** as you appear first
2. Users you haven't followed yet
3. Maximum 5 suggestions at a time
4. Randomized so you discover new creators each visit

---

## 🛒 Shop (`/shop`)

A built-in marketplace for creators:
- Browse and search products
- Add to cart
- Checkout with saved addresses
- Track orders
- Manage your storefront as a seller

---

## 💰 Wallet (`/wallet`)

- View your **coin balance**
- Earn coins through platform engagement
- Spend coins on platform features

---

## 📤 Upload (`/upload`)

Upload short-form videos:
- Supported formats: MP4, MOV, AVI, WMV
- Max size: 100MB
- Add a caption and select a category
