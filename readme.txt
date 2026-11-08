=== Unstoppable Voting, Polls & Elections ===
Contributors: paramedic192
Tags: polls, voting, elections, ballot, surveys
Requires at least: 5.8
Tested up to: 7.1
Requires PHP: 7.4
Stable tag: 2.2.0
License: GPL-2.0-or-later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Secure polls and formal elections for WordPress. Five ballot templates, powerful sorting, duplicate-vote prevention — all free.

== Description ==

**Unstoppable Voting, Polls & Elections** is a standalone, no-nonsense voting plugin built for the way organizations actually run elections and polls. Whether you're a non-profit electing trustees, an HOA voting on board members, a school running student government elections, a church choosing deacons, a club picking captains, or a sports league selecting tournament participants — this plugin handles it cleanly. No upsells, no "Pro" lock-in, no third-party services.

= Who this plugin is for =

* **Non-profits, clubs, and associations** running officer or board elections
* **HOAs and condo boards** voting on rules, budgets, and trustees
* **Schools and student groups** for student government, class polls, MVP voting
* **Churches and religious organizations** electing deacons, council members, or leaders
* **Sports leagues** for officer elections and tournament selections
* **Businesses and teams** running internal polls or decisions
* **Anyone** running a casual or formal vote on a WordPress site

= Five Templates Included (all free) =

* **Classic Bars** — Familiar horizontal bar chart, works on any layout
* **Official Ballot** — Formal numbered-option look for elections
* **Candidate Cards** — Photo + name grid, ideal for headshots, team logos, or product images
* **Compact List** — Sidebar-friendly minimal style
* **Tournament** — Head-to-head matchups for bracket-style voting

= Seven Sort Orders (all free) =

Sort options however you need: manual drag-to-reorder, alphabetical (A→Z or Z→A), most votes first, least votes first, random, or by date added. Most competitors paywall these — here they're standard.

= Built-In Vote Integrity =

* Block duplicate voting by cookie, IP, both, or none — per poll
* Registered users are always blocked from voting twice
* Toggle guest voting on or off per poll
* Single-choice or multiple-choice with configurable max selections
* Schedule polls with optional start and end dates

= Display Control =

* Show results: before voting, after voting, only when closed, or admin-only
* Format results as percent, vote count, or both
* Draft polls hidden from the public automatically

= Easy to Use =

Drop a poll anywhere with one shortcode: `[uvpe_poll id="123"]` — works in posts, pages, widgets, page builders (Elementor, Gutenberg, etc.), or anywhere WordPress accepts shortcodes.

= Standalone & Self-Contained =

No WooCommerce required. No external services. No license activation. No phone-home. Free, GPL, and self-contained.

== Installation ==

1. Upload the plugin folder to `/wp-content/plugins/` or install via the WordPress plugin directory.
2. Activate the plugin through the **Plugins** menu in WordPress.
3. Go to **Voting → Add New** to create your first poll.
4. Copy the shortcode from the poll edit screen and paste it into any page, post, or widget.

== Frequently Asked Questions ==

= Does this require WooCommerce or any other plugin? =

No. Unstoppable Voting, Polls & Elections is fully standalone. It works on any WordPress site running 5.8 or newer with PHP 7.4 or newer.

= Can I let people vote without logging in? =

Yes. Each poll has an **Allow guest voters** toggle. When enabled, anyone can vote (subject to your duplicate-vote settings).

= How do you prevent duplicate voting? =

You can choose per poll: cookie-based blocking (basic, works for most sites), IP-based blocking (stricter), both combined, or no blocking at all. Logged-in users are always blocked from voting twice regardless of the setting.

= Can I see who voted for what? =

The plugin stores user IDs alongside votes (for logged-in voters) so you have a record. The admin Results page shows aggregate vote counts and rankings. Detailed per-vote audit views are planned for a future release.

= Can I schedule polls to open and close automatically? =

Yes. Each poll has optional start and end date fields. Outside that window the poll won't accept new votes.

= Is this suitable for binding elections? =

The plugin gives you strong duplicate-vote prevention, scheduling, and audit-friendly result tracking — but whether a digital vote is binding depends on your organization's bylaws and applicable law. We recommend treating online voting as a recommendation tool unless your governing documents explicitly authorize it.

= What happens to my data if I delete the plugin? =

Deactivating the plugin keeps all your polls and votes intact. Deleting the plugin from the Plugins screen removes all tables and options. There is no soft-delete — back up first if you want to keep your data.

= Can I customize the template styles? =

Yes. All CSS uses CSS custom properties for easy overriding from your theme. The main accent color can also be changed in **Voting → Settings**.

= Can voters change their vote after submitting? =

Not yet. Once a vote is cast, it's locked in. A future release may add a vote-revision window for organizations that need it.

== Screenshots ==

1. The polls list with status pills and stat cards.
2. The Official Ballot template — clean, formal look for elections.
3. The Candidate Cards template — photo grid for nominees, teams, or items.
4. The Tournament template — head-to-head matchup voting.
5. Poll edit screen with drag-to-reorder options and per-poll settings.
6. Admin results view with ranked options and vote distribution bars.

== Privacy ==

This plugin runs entirely on your own WordPress site. It makes no outbound HTTP requests and contacts no external services.

When a visitor casts a vote, the following data is stored in your WordPress database:

* The chosen answer ID(s) and the poll ID.
* The timestamp of the vote.
* The WordPress user ID, if the visitor is logged in.
* The visitor's IP address, **only if** you have enabled the IP-based duplicate-vote prevention option on that specific poll. Polls that use cookie-only or "no checks" duplicate prevention do not store IPs.
* A short-lived cookie on the visitor's browser, only if you have enabled cookie-based duplicate-vote prevention on that poll.

No data ever leaves your site. Deleting the plugin from the Plugins screen removes all stored poll and vote data along with the plugin's database tables and options.

== Changelog ==

= 2.2.0 =
* **New: Gutenberg block** — Insert any of your polls into a page or post from the block picker without copying shortcodes. Search for "Poll" in the inserter, pick the poll from a dropdown in the block sidebar, and get a live preview in the editor. On the frontend, the block renders through the same shortcode handler, so results, templates and duplicate-vote prevention all behave exactly the same as `[uvpe_poll]`. Converting an existing shortcode block to the new block is supported via the block transforms API.
* **Compatibility:** Tested with WordPress 7.1 "Mary Lou" and PHP 8.3.
* **Internal:** No schema changes; safe to downgrade back to 2.1.0 if needed.

= 2.1.0 =
* **New: Duplicate poll** — "Duplicate" row action on the polls list copies a poll (and its answer options, images, and settings) into a new draft so you can clone recurring votes without rebuilding them. Votes are not copied.
* **New: Extensibility hooks** — Added a stable set of actions and filters (`uvpe_loaded`, `uvpe_can_user_vote`, `uvpe_before_vote_cast`, `uvpe_after_vote_cast`, `uvpe_vote_data`, `uvpe_templates`, `uvpe_poll_row_actions`, `uvpe_schema_tables`, `uvpe_duplicate_poll_data`, `uvpe_poll_duplicated`, `uvpe_schema_upgraded`) so companion add-ons can extend the plugin without modifying its code.
* **New: Database schema v2** — Added a `vote_revision_window` field to polls (minutes a voter has to change their vote after submitting) and a `revised_at` timestamp to votes. The admin field is live on the Settings panel of each poll; a frontend "change my vote" flow follows in 2.2.0.
* **Compatibility: Tested with WordPress 7.1** ("Mary Lou").
* **Fix: Blank scheduling dates were being saved as MySQL zero-dates** (`0000-00-00 00:00:00`), which caused the plugin to treat the poll as "ended" and hide the vote form, even though the Start/End date fields are documented as optional. Blank dates are now stored as proper SQL NULLs, and `is_open()` and the edit screen defensively treat any lingering zero-dates as empty — so previously-broken polls become votable again on this release without needing a fresh save.
* **Internal: Automatic schema migration** — Existing installs upgrade transparently on first load; no manual action required.

= 2.0.7 =
* Added a "Privacy" section to the readme describing exactly what data the plugin stores locally (vote records, optional IPs/cookies for duplicate-vote prevention) and confirming no data leaves the site.
* No code changes.

= 2.0.6 =
* Replaced the admin-menu colour styles with a proper `wp_register_style()` + `wp_add_inline_style()` enqueue (no more raw `<style>` block in the admin head).
* Removed the welcome banner and review-request notice for the initial release to keep the admin dashboard fully uncluttered. Future versions may reintroduce a small, dismissible welcome notice restricted to the plugin's own settings page.
* No functional changes to polls, votes, or the shortcode.

= 2.0.5 =
* Extended the schema drop-tables `phpcs:ignore` to also cover the `WordPress.DB.DirectDatabaseQuery.SchemaChange` sub-rule (schema changes are intentional in the uninstall path).
* No functional changes.

= 2.0.4 =
* Second-pass Plugin Check remediation.
* Refactored vote-submission AJAX to sanitize the array inline with the `$_POST` access.
* Consolidated multi-line `$wpdb->query()` and `$wpdb->get_var()` calls onto single lines so the existing `phpcs:ignore` directives correctly cover the interpolated SQL on the same line.
* Extended the schema drop-tables `phpcs:ignore` to include `InterpolatedNotPrepared`.
* No functional changes.

= 2.0.3 =
* Plugin Check remediation pass for WordPress.org submission.
* Inlined output escaping in the answer-row editor for scanner compatibility.
* Added explicit array sanitization on the vote-submission AJAX endpoint before integer casting.
* Added `wp_unslash()` to admin GET reads for poll IDs.
* Extended phpcs ignore directives on safe table-name interpolations (all values still bound via `$wpdb->prepare()`).
* Suppressed false-positive prefix warnings on local view/template variables.
* No functional changes.

= 2.0.2 =
* Updated "Tested up to" header to WordPress 7.0 for compatibility with the current major release.
* No functional changes.

= 2.0.1 =
* Submission-readiness fixes for WordPress.org.
* Corrected license header in readme to the exact `GPL-2.0-or-later` SPDX identifier.
* Added `wp_unslash()` to one missed superglobal access in the admin delete handler.
* Added direct-access guards to silence-index files in every subdirectory.
* No functional changes — polls, votes, and settings are preserved.

= 2.0.0 =
* First release on WordPress.org. Updates are now delivered through WordPress's standard update mechanism.
* Five frontend templates: Classic Bars, Official Ballot, Candidate Cards, Compact List, Tournament.
* Seven option-sort orders: manual, alphabetical (asc/desc), most votes, least votes, random, by date added.
* Single-choice or multiple-choice voting with configurable max selections.
* Optional poll scheduling with start and end dates.
* Duplicate-vote prevention by cookie, IP, both, or none — configurable per poll.
* Guest voting toggle per poll.
* Four result-display modes (before vote, after vote, when closed, admin-only).
* Admin Results page with rankings and vote distribution bars.
* Shortcode: `[uvpe_poll id="N"]`.

== Upgrade Notice ==

= 2.2.0 =
Adds a Gutenberg block so you can insert polls from the block picker instead of pasting shortcodes. Safe to upgrade — no schema changes.

= 2.1.0 =
Adds the Duplicate-poll action, a Pro-ready extensibility hook set, and the schema groundwork for the upcoming vote-revision window. Safe to upgrade — existing polls, votes, and settings are preserved.

= 2.0.7 =
Added a Privacy section to the readme. No code changes.

= 2.0.6 =
Refactored admin-menu styling to use the WordPress enqueue API and removed admin-dashboard notices. Safe to upgrade.

= 2.0.5 =
Final cleanup pass for Plugin Check. No functional changes. Safe to upgrade.

= 2.0.4 =
Cleanup pass for Plugin Check warnings. No functional changes. Safe to upgrade.

= 2.0.3 =
Internal code-quality fixes for WordPress.org Plugin Check. No functional changes. Safe to upgrade.

= 2.0.2 =
Compatibility metadata update for WordPress 7.0. Safe to upgrade.

= 2.0.1 =
Internal hardening and submission-readiness fixes. Safe to upgrade — all polls, votes, and settings are preserved.

= 2.0.0 =
First WordPress.org release. If you previously installed an earlier build from Unstoppable Solutions directly, upgrading to 2.0.0 will preserve all your existing polls and votes — only the update mechanism changes.
