# Database Schema

## Tables Overview

```
users               Core user accounts
videos              All uploaded videos
live_sessions       Live streaming sessions
follows             Follow relationships
likes               Video likes
comments            Video comments
comment_likes       Comment likes
bookmarks           Saved videos
reposts             Reposted videos
shares              Shared videos
notifications       User notifications
messages            Direct messages
addresses           User delivery addresses
cart_items          Shopping cart
products            Shop products
payment_methods     Saved payment methods
```

---

## Table Details

### `users`
| Column | Type | Description |
|---|---|---|
| id | bigint | Primary key |
| name | string | Full display name |
| username | string | Unique @handle |
| email | string | Unique email |
| password | string | Hashed password |
| avatar | string | Profile picture URL |
| bio | text | Short bio |
| location | string | City (e.g. "Kigali") — used for feed personalization |
| language | string | `en` or `rw` |
| balance | integer | Coin balance |
| dark_mode | boolean | UI theme preference |
| push_notifications | boolean | Notification preference |

### `videos`
| Column | Type | Description |
|---|---|---|
| id | bigint | Primary key |
| user_id | bigint | FK → users |
| video_url | string | URL to video file |
| thumbnail_url | string | URL to thumbnail image |
| caption | text | Video description |
| category | string | Content category |
| music_name | string | Background music label |
| likes_count | integer | Cached like count |
| comments_count | integer | Cached comment count |
| reposts_count | integer | Cached repost count |
| shares_count | integer | Cached share count |
| bookmarks_count | integer | Cached bookmark count |

### `live_sessions`
| Column | Type | Description |
|---|---|---|
| id | bigint | Primary key |
| user_id | bigint | FK → users (broadcaster) |
| title | string | Stream title |
| description | text | Stream description |
| thumbnail_url | string | Cover image URL |
| is_active | boolean | Whether stream is live |
| started_at | timestamp | Stream start time |
| ended_at | timestamp | Stream end time |

### `follows`
| Column | Type | Description |
|---|---|---|
| follower_id | bigint | FK → users (the one who follows) |
| following_id | bigint | FK → users (the one being followed) |

### `messages`
| Column | Type | Description |
|---|---|---|
| sender_id | bigint | FK → users |
| receiver_id | bigint | FK → users |
| message | text | Message content |
| is_read | boolean | Read status |
| type | string | `text`, `image`, etc. |

---

## Key Relationships

```
User
 ├── hasMany Videos
 ├── hasMany LiveSessions
 ├── hasMany Notifications
 ├── hasMany Messages (sent & received)
 ├── hasMany Addresses
 ├── hasMany CartItems
 ├── belongsToMany Users (followers / following via follows table)
 └── belongsToMany Comments (liked comments via comment_likes)

Video
 ├── belongsTo User
 ├── hasMany Comments
 ├── hasMany Likes
 ├── hasMany Bookmarks
 ├── hasMany Reposts
 └── hasMany Shares
```
