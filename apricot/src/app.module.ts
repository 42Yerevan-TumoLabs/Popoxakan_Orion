import { Module } from '@nestjs/common';
import { AppController } from './app.controller';
import { AppService } from './app.service';
import { PostModule } from './post/post.module';
import { doc } from 'prettier'
import join = doc.builders.join

@Module({
  imports: [TypeOrmModule.forRoot({
    type: 'postgres',
    port: 'localhost',
    port: 5433,
    database: 'crash-course-nestjs',
    username: 'postrges',
    password: '12345',
    entities: [join(__dirname + '/ .. /**/*.entity{.ts,.js)')],
    migrations: [join(__dirname + '/ .. /**/*.migration{.ts, .js}')],
    synchronize: true,
  }),
    PostModule
  ],
  controllers: [AppController],
  providers: [AppService],
})
export class AppModule {}
