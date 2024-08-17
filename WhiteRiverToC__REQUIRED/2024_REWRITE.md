* Its been so long, I dont even remember the flow of all the quests
* Share screenshot of other quests on the back-burner
* Who is "7DaystoDie.JP"? Noted in the ModInfo.xmls of the Mods in the pack (what was the provenance of the source code they used to modify)
* Interesting note: In terms of the first letter of each mod, we have more than 50% of the letters of the alphabet

### 7DTD v1.0 White River Tools of Citizenship, Core Citizenship Modlet Rewrite


THE PROBLEM:
* We don't have custom dialog that we can trigger for a wholly trader-based chat dialog for quest management.
* We don't have any sort of "UI" that shows the player all of the different quests that are possible with their citizenship.
* Basing citizenship into a society on the number of zombie kills in a world where everyone is killing zombies does not seem particularly fitting and would have no basis for being tracked by the society. (Realism)

THE CHALLENGE:
Rewrite the "required" core modlet for the tools of citizenship and re-think the new player experience, resulting in something that better meshes with the vanilla experience while also not requiring a major rewrite of the quest management across all the quests in the pack. Minimize resource loopholes that would otherwise allow a player to cheat through starting multiple consecutive low-effort tasks.

ANALYSIS OF BUILT-IN QUEST SYSTEM:
TFP added a trader-based quest system some time ago and chose to go with a tiering structure that only unlocks after you've completed a certain number of quests in the previous tier. On the surface this seems like a good match with ToC until you consider that the quests that are offered up by the trader are basically random. This wholly removes the control the player currently has over taking on exactly whatever ToC quest they want at a specific time. It is because of this that this modlet pack does not base its quest system on the built-in TFP quest system.

=-=-=-=-=-=-=-=-=-=-=-=

TFP has added a Challenges window that in the base game that has a new player go through a set of initial tasks (challenges) to collect or craft an item. It also is used to track whether the player has located each trader and other collection and crafting related accomplishments. The challenges window has normally three tabs to it for Basic, Advanced, and Twitter. I've proven out creating an extra tab to this page that would provide an entire page of challenges to the player representing the White River Tools of Citizenship quests that are loaded on the server. This would allow the quests within the pack to visually be presented to the player, and provides a larger UI for initial quest text enticing them to take on each quest.

If we span a 12 quests across two challenge groups (maybe 7 in one, 5 in the other), both challenge groups could unlock at the same time both using a singular challengegroup to unlock it. The final challenge in the second challengegroup is what completes the tier. The completion of that challengegroup specifically would be used as the trigger to unlock the next tier's challengegroup. Through this methodology, we could set it up so that a single tier of quests within the modpack span across two challengegroups. The only issue we could run into is in rare situations where a server operator chooses to run so few modlets from the pack that there would be no entries  for a challengegroup. In a case like this, players would get stuck unable to progress through the tiers of ToC. But the upside is visually spanning the tier across two challengegroups would fill in the page more vertically and also ensure there is room for growth into the future.

=-=-=-=-=-=-=-=-=-=

At end of "Journey to the Settlement" quest there is a "Talk to the Trader" step. In it the final rewards popup has text:

    "Noah sent you eh? We have a variety of types of challenging quests for you. You can either talk to me for some simple quests or if you are interested in actually contributing around here, read over this +Declaration of Citizenship. Take this shovel and move along.
+ Declaration of Citizenship, which is ingredient to start any basic-tier quest"


    1. Completion of the "Basic" challenge group also opens up the ToC Basic Quests from the Challenge window.
    2. Claiming each challenge reward obtains the ToC quest starter item and gives you citizen card back upon successful completion of the quest.
    3. Completing a challenge grants you a Basic tier ToC completion token.
    4. The last challenge of the basic tier challenge is to obtain ___ number of basic tier completion tokens & then use them to craft the veteran citizenship card. This completes the Basic ToC challengegroup and unlocks the Veteran ToC challengegroup.
    5. Claiming each challenge reward obtains the ToC quest starter item and gives you veteran citizen card back upon successful completion of the quest.
    6. Completing a challenge grants you a Veteran tier ToC completion token.
    7. The last challenge of the veteran tier challenge is to obtain ___ number of veteran tier completion tokens & then use them to craft the elite citizenship card. This completes the Veteran ToC challengegroup and unlocks the Elite ToC challengroup.
    8. Claiming each challenge reward obtains the ToC quest starter item and gives you elite citizen card back upon successful completion of the quest.

=-=-=-=-=-=-=-=-=-=-

The declaration of citizenship card can be crafted from a piece of paper and is the only ingredient to craft quest starter item for any of the Initiate level quests.
Each completed quest rewards a completion token for either Initiate, Citizen, or Veteran. Elite quests don't need to return completion token as there is no larger tier.
Completion tokens are used to craft the citizenship card for the next tier up. 

##### White River Initiate (Declaration of Citizenship)

Challenge Tier 1:
- Taza's Axe (Initiate) - Level 1 (New Quest Tier) initiatequestitem_toc_taza_name
- Dundee's Knife (Initiate) - Level 1-2 (New Quest Tier) initiatequestitem_toc_dundee_name
- Jason's Machete (Moved Quest) questitem_toc_jason_name ** needs renamed
- Brass For Lead (Moved Quest) questitem_toc_brass_name ** needs renamed
- Bear Grylls's Iron Knuckles (Moved Quest) questitem_toc_claws_nam ** needs renamed
+ Craft White River Citizen Card

##### White River Citizen Card

Challenge Tier 1:
- Taza's Axe (Citizen) - Level 2-3 questitem_toc_taza_name
- Dundee's Knife (Citizen) - Level 3-6 questitem_toc_dundee_name
- Bambi's Compound Bow questitem_toc_bambi_name
- Everdeen's Arrows & Bolts questitem_toc_earrows_name
- Bear Grylls's Iron Knuckles (Moved Quest) vetquestitem_toc_claws_name

Challenge Tier 2: (Both Challenge Tiers Unlock Same Time)
- Bunyan's FireAxe questitem_toc_bunyan_name
- Leon's SMG questitem_toc_leon_name
- Kuva's Armor questitem_toc_kuva_name
- Deschain's Revolver questitem_toc_desch_name
+ Craft Veteran Citizen Card

##### White River Veteran Citizen Card (Veteran Challenge Tiers Unlock upon Completion of White River Citizen Card Challenge Tier 2)

Challenge Tier 1:
- Taza's Axe (Veteran) - Level 4-6 vetquestitem_toc_taza_name
- Rick Danger Auger vetquestitem_toc_rickdanger_name
- BlackBart's Dig Tools vetquestitem_toc_blackb_name
- Bambi's Compound Bow vetquestitem_toc_bambi_name
- Leon's SMG vetquestitem_toc_leon_name
- Kuva's Armor vetquestitem_toc_kuva_name

Challenge Tier 2: (Both Challenge Tiers Unlock Same Time)
- Daryl's Compound Crossbow vetquestitem_toc_daryl_name
- Pavlichenko's Rifle vetquestitem_toc_pav_name
- Molino Bulletproof Glass Blocks vetquestitem_toc_glassNonFuzzyBulletproofBlockVariantHelper_name
- Gupta's Bandages questitem_toc_gupta_name
- Amelia Earhart's Gyrocopter questitem_toc_amelia1_name
+ Craft Elite Citizen Card

##### White River Elite Citizen Card (Elite Challenge Tiers Unlock upon Completion of White River Veteran Citizen Card Challenge Tier 2)

Challenge Tier 1:
- Spirit of Vengeance  questitem_spirit_vengeance_name
- Rick Danger Auger elitequestitem_toc_rickdanger_name
- Remington's Steel Ammo elitequestitem_toc_remington_name
- Daryl's Crossbow elitequestitem_toc_daryl_name
- Bambi's Compound Bow elitequestitem_toc_bambi_name
- Molino Bulletproof Glass Recipe elitequestitem_toc_glassNonFuzzyBulletproofBlockVariantHelper_name