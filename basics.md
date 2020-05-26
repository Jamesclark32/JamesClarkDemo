Basic CS Section
---
#### A) SQL DB for NBA data 

This is good real-world example in that I know very little about the dataset myself - I'm not much of a basketball fan. I've put together what I believe is a good start. In a real case, I would be eager to vet this against the knowledge of the rest of the team and look for the many data points and use cases I am overlooking.

I have these deliverables for this section:
1) a rough UML diagram found at [dataModelUml.png](dataModelUml.png)
2) the UML notation which generated this diagram, found at [dataModelUml.txt](dataModelUml.txt)
3) Laravel migrations for the tables denoted in these UML documents:
 
* [database/migrations/2020_05_24_121340_create_cities_table.php](database/migrations/2020_05_24_121340_create_cities_table.php)
* [database/migrations/2020_05_24_121427_create_game_statuses_table.php](database/migrations/2020_05_24_121427_create_game_statuses_table.php)
* [database/migrations/2020_05_24_121428_create_games_table.php](database/migrations/2020_05_24_121428_create_games_table.php)
* [database/migrations/2020_05_24_121439_create_teams_table.php](database/migrations/2020_05_24_121439_create_teams_table.php)
* [database/migrations/2020_05_24_121454_create_players_table.php](database/migrations/2020_05_24_121454_create_players_table.php)
* [database/migrations/2020_05_24_121505_create_events_table.php](database/migrations/2020_05_24_121505_create_events_table.php)
* [database/migrations/2020_05_24_121523_create_game_team_pivot_table.php](database/migrations/2020_05_24_121523_create_game_team_pivot_table.php)
* [database/migrations/2020_05_24_121536_create_game_player_pivot_table.php](database/migrations/2020_05_24_121536_create_game_player_pivot_table.php)
* [database/migrations/2020_05_24_121547_create_team_player_pivot_table.php](database/migrations/2020_05_24_121547_create_team_player_pivot_table.php)
* [database/migrations/2020_05_24_121601_create_event_game_pivot_table.php](database/migrations/2020_05_24_121601_create_event_game_pivot_table.php)
* [database/migrations/2020_05_24_124619_create_player_statistics_table.php](database/migrations/2020_05_24_124619_create_player_statistics_table.php)

I am particularly inconfident in the player_statistics table, and would expect this to evolve based on specific wireframes revealing data and query needs. It's intent is to hold frequently displayed calculated stat summaries for players.  This data can be derived from the information in the other tables. A process would likely need to update this table at the conclusion of any game.

---

#### B) Deletion of files beginning with "0aH"

I assume this speaks to a one-off, unique need. Given that, I would use the unix 'find' command. Specifically, I would first try to verify it was finding what I was expecting by manually inspecting the results of 
`find . -name '\0aH*'` from the relevant base folder. That the string begins with `0` is certainly of note, but the escaping backslash should resolve any issues caused by this.
 
Once I felt confident in the results, I would run `find . -name '\0aH*' -delete` to actually delete the files.

Depending on the context (e.g. are we on a server?), I would likely make a full backup of the folder prior to running the second command, and possibly look for a pairing partner to put second eyes on the problem. Deleting data is scary and I'm fallible. :) 

To put this into a Laravel context, I have put together an artisan command towards this problem.
All files relevant to this:

* [app/Console/Commands/Purge0aHFiles.php](app/Console/Commands/Purge0aHFiles.php)
* [app/Utilities/Console/Commands/Purge0aHFiles.php](app/Utilities/Console/Commands/Purge0aHFiles.php)
* [resources/lang/en/console/commands/purge_0aH_files.php](resources/lang/en/console/commands/purge_0aH_files.php)

---

#### C) Sort 11 small numbers as fast as possible

This is an interesting problem. Modern hardware has reduced speed comparisons between languages, and the developer has become a biggest variable in the equation. Obviously a specific solution written solely in C could be, if written right, significantly faster than something in PHP. However, that difference is going to be very small and require a pretty specific use case and very heavy usage to be of any note. Running the process 10 Billion times amplifies the differences to a point of note. 

Given the scope of Laravel / PHP, the most performant solution is to simply use the php native function sort(). The results I'm seeing for 10 Billion is ~4.45 hours. Not very practical for any real world need!

Discussions about practicality aside, I've implemented a counting sort solution. Switching to this over the native sort() raised run time for 10 Billion runs to ~ 44 hours.   

Code can be found in the artisan command at:

* [app/Console/Commands/BenchmarkSort.php](app/Console/Commands/BenchmarkSort.php)
* [app/Utilities/Sort/CountingSort.php](app/Utilities/Sort/CountingSort.php)
* [resources/lang/en/console/commands/benchmark_sort.php](resources/lang/en/console/commands/benchmark_sort.php)

---

#### D) sort 10,000 powers 

Another interesting sorting problem.  

For this I've implemented a quick sort algorithm. There are some usage assumptions about elements being arrays with sorting being a direct comparison of a specified element which would need to be addressed for it to be a solid, reusable solution. Perhaps passing a closure in would be a good next step. I'm seeing run times around .38 seconds on my local workstation.

The code can be found at: 

* [app/Console/Commands/BenchmarkSortPowers.php](app/Console/Commands/BenchmarkSortPowers.php)
* [app/Utilities/Sort/QuickSort.php](app/Utilities/Sort/QuickSort.php)
* [resources/lang/en/console/commands/benchmark_sort_powers.php](resources/lang/en/console/commands/benchmark_sort_powers.php)


