# Feed Algorithm — "For You"

## Overview

The "For You" feed is AmazamaHub's core discovery engine. Instead of simply showing the newest videos, it uses a **weighted scoring algorithm** to surface the most relevant content for each user.

---

## Priority Tiers

When you load `/?type=foryou`, videos are ranked using this system:

| Score | Condition |
|---|---|
| **+2** | Video creator is someone you **follow** |
| **+1** | Video creator is in your **same city** |
| **+3** | Video creator is someone you **follow AND** is in your **same city** |
| **0** | All other videos |

Videos within the **same score tier** are randomly shuffled on every request, so the feed feels fresh and dynamic each time you refresh.

---

## Algorithm Code Reference

```php
// VideoController.php — index() method
if ($type === 'foryou') {
    $followingIds = $user->following()->pluck('following_id');
    $location     = $user->location;

    $query
        ->join('users', 'videos.user_id', '=', 'users.id')
        ->addSelect(DB::raw("
            (CASE WHEN users.id IN (:followingIds) THEN 2 ELSE 0 END +
             CASE WHEN users.location = :location THEN 1 ELSE 0 END) as score
        "))
        ->orderByDesc('score')  // Priority order
        ->inRandomOrder();      // Shuffle within tiers
}
```

---

## Infinite Scroll & Pagination

The feed uses **server-side pagination** (10 items per page).

When the user scrolls to the bottom of the page, the frontend automatically requests the next page and appends the videos to the existing feed — creating a seamless, infinite scroll experience.

```
Page 1: Score 3 videos (followed + local) → random order
Page 1: Score 2 videos (followed only)    → random order
Page 1: Score 1 videos (local only)       → random order
Page 1: Score 0 videos (everyone else)    → random order
...
Page 2: Continues from where page 1 left off
```

---

## Location Setup

A user's location is set via **Settings → Account → Location**.

Available cities:
- Kigali
- Musanze
- Butare
- Gisenyi
- Kibuye
- Gitarama

Changing your location **immediately affects** both:
1. Your "For You" feed (which local videos you see)
2. Sidebar "Suggested Accounts" (which local creators are recommended)

---

## "Following" Feed

The `?type=following` feed is simpler — it only shows videos from accounts you follow, ordered by recency.

---

## Suggested Accounts Algorithm

The sidebar "Suggested Accounts" uses the same location-priority logic:

```php
User::where('id', '!=', $currentUserId)
    ->whereDoesntHave('followers', ...)  // Not already following
    ->orderByRaw("CASE WHEN location = ? THEN 0 ELSE 1 END", [$userLocation])
    ->inRandomOrder()
    ->limit(5)
    ->get()
```

Local users (same city) always appear before users from other cities.
