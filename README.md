# Truelab Fixture Bundle

Truelab Fixture Bundle allow to import and export fixtures from db to some format (yml at the moment) and viceversa.

```
#!bash
php app/console truelab:fixture:import
php app/console truelab:fixture:export
```

## Process

The command line use a Process that with many FixtureManagers transform data into entities and entities into data. If you want to add a FixtureManager to some process you can do it with a tag.
```
#!xml
<!-- for import -->
<tag name="truelab_fixture.import_fixture_manager" />
<!-- for export -->
<tag name="truelab_fixture.export_fixture_manager" />
```
### The import process

Every fixture manager during the import process follows these steps:

1. Load data with a **DataManager**
2. Decode the data with a parser into a **FixturePack**
3. Transform the fixtures pack into an **EntityCollection**
4. Save the data with an **EntityManager**

For each step an event is dispatched so you can extend how the data is processed.

```
truelab_fixture.data_manager_load
truelab_fixture.parser_decode
truelab_fixture.packer_unpack
```

### The export process

Every fixture manager during the export process follows these steps:

1. Load an EntityCollection from db
2. Trasform the EntityCollection into a **FixturePack**
3. Encode the FixturePack into some data
4. Save the data (into filesystem)

```
truelab_fixture.entity_manager_load
truelab_fixture.packer_pack
truelab_fixture.parser_encode
```

## Packers

Packers are the core part of the process. The transform entity into FixturePack using several Analyzers. You can inject new analyzers or override existing analyzers to change how packer behaves.

## The Analyzers

If you want to change how a single property is managed you have to add an analyzer to all Packers you need.

```
#!xml
<call method="addAnalyzer">
    <argument type="service" id="my_analyzer" />
</call>
```

Every Analyzer has 2 methods **fromEntity** which set a fixture property analyzing a ReflectionProperty and **fromFixture** which set an entity property analyzing a Fixture.




